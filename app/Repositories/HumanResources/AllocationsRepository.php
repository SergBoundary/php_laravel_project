<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Objects;
use App\Models\HumanResources\Teams;
use App\Models\Settings\Users;
use App\Models\HumanResources\Allocations as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class AllocationsRepository: Репозиторий учета должностных назначений работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class AllocationsRepository extends CoreRepository {

    /**
     * @return string
     */
    protected function getModelClass() {

        return Model::class;
    }

    /**
     * Получить список данных
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getTable() {
		
        $user = Auth::user();

        if($user['access'] == 4) {
            $result = $this->startConditions()
                ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                ->join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname', 'personal_cards.first_name', 'objects.title AS object', 'teams.abbr AS team', 'allocations.start', 'allocations.expiry', 'allocations.id')
                ->where('personal_cards.id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('allocations.start')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                ->join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname', 'personal_cards.first_name', 'objects.title AS object', 'teams.abbr AS team', 'allocations.start', 'allocations.expiry', 'allocations.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('allocations.start')
                ->get();
        } else {
            $result = $this->startConditions()
                ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                ->join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname', 'personal_cards.first_name', 'objects.title AS object', 'teams.abbr AS team', 'allocations.start', 'allocations.expiry', 'allocations.id')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('allocations.start')
                ->get();
        }

       return $result;
    }

    /**
     * Получить персональные данные сотрудника
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getPersonalCard($id) {

        $columns = [
            'id', 
            'personal_account', 
            'surname', 
            'first_name', 
            'second_name', 
            'full_name_latina', 
            'sex', 
            'born_date', 
            'phone', 
            'photo_url', 
        ];

        $result = PersonalCards::select($columns)
            ->find($id);

        return $result;
    }

    /**
     * Получить данные об авторе записи
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getAutor($id) {

        $columns = [
            'id',
            'name',
            'email',
            'access',
        ];

        $result = Users::select($columns)
            ->find($id);

        return $result;
    }

    /**
     * Получить модель для редактирования данных одной записи
     *
     * @param int $id
     *
     * @return Model
     */
    public function getAllocation($id) {
        
        $columns = [
            'objects.title AS object',  
            'teams.title AS team', 
            'allocations.id',
            'allocations.user_id',
            'allocations.personal_card_id',
            'allocations.object_id',
            'allocations.team_id', 
            'allocations.start', 
            'allocations.expiry', 
        ];

        $result = $this->startConditions()
            ->join('objects', 'allocations.object_id', '=', 'objects.id')
            ->join('teams', 'allocations.team_id', '=', 'teams.id')
            ->select($columns)
            ->where('allocations.id', $id)
            ->first();

        return $result;
    }

    /**
     * Получить модель для представления данных одной записи
     *
     * @param int $id
     *
     * @return Model
     */
    public function getShow($id) {

        $result = $this->startConditions()
            ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
            ->join('objects', 'allocations.object_id', '=', 'objects.id')
            ->join('teams', 'allocations.team_id', '=', 'teams.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'objects.title AS object', 'teams.title AS team', 'allocations.start', 'allocations.expiry', 'allocations.id')
            ->where('allocations.id', $id)
            ->toBase()
            ->first();

        return $result;
    }

    /**
     * Получить модель для редактирования данных одной записи
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id) {

        $columns = ['id', 'user_id', 'personal_card_id', 'object_id', 'team_id', 'start', 'expiry', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

    /**
     * Получить модель для редактирования даты снятия работника с объекта или бригады
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEditExpiry($id, $expiry) {
        // На бригадира не распространяется, кроме случая снятия с должности
        $columns = ['id', 'start', 'expiry', ];

        $result = $this->startConditions()
            ->select($columns)
            ->where('personal_card_id', $id)
            ->whereNull('expiry')
            ->orderBy('start', 'desc')
            ->first();
        
        $result->expiry = $expiry;
//        $result->save();
        
//        $result['expiry'] = $expiry;
//        dd($result);

        return $result;
    }

    /**
     * Закрыть актуальное перемещение
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getEditClose($id, $date) {
        $update = $this->startConditions()
                ->where('id', $id)
                ->whereNull('expiry')
                ->first();
        $expiry = date("Y-m-d", strtotime("-1 day ".$date));
        dd($date, $expiry);
        $update->expiry = $expiry;
    }

    /**
     * Открыть новое перемещение
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function openAllocation($id, $date) {
        
    }

    /**
     * Получить модель для раскрывающегося списка данных
     *
     * @param int $i
     *
     * @return Model
     */
    public function getListSelect($i) {

        switch ($i) {
            case 0:
                $columns = implode(", ", ['id', 'CONCAT(surname, " ", first_name, " ", second_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
                    ->orderBy('surname')
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'title AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS team']);
                $result = Teams::selectRaw($columns)
                    ->whereNull('expiry')
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}