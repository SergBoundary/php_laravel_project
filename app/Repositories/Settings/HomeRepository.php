<?php

namespace App\Repositories\Settings;

use Illuminate\Support\Facades\Auth;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;


use App\Models\Settings\Home as Model;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Allocations;
use App\Models\HumanResources\ManningOrders;

/**
 * Class TeamsRepository: Репозиторий учета формирования бригад
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class HomeRepository extends CoreRepository {

    /**
     * @return string
     */
    protected function getModelClass() {

        return Model::class;
    }

    /**
     * Получить список персональных данных
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getPersonalActuality($id) {

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
     * Получить данные о последнем назначении 
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getManningOrderActuality($id) {
        
        $columns = [
            'departments.title AS department', 
            'positions.title AS position', 
            'position_professions.title AS profession', 
            'position_professions.code AS profession_code', 
            'assignment_date', 
            'resignation_date', 
        ];

        $result = ManningOrders::join('departments', 'manning_orders.department_id', '=', 'departments.id')
            ->join('positions', 'manning_orders.position_id', '=', 'positions.id')
            ->join('position_professions', 'manning_orders.position_profession_id', '=', 'position_professions.id')
            ->select($columns)
            ->where('personal_card_id', $id)
            ->whereNull('resignation_date')
            ->orderBy('assignment_date', 'desc')
            ->first();

        return $result;
    }

    /**
     * Получить данные о последнем перемещении 
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getAllocationActuality($id) {
        
        $columns = [
            'objects.title AS object', 
            'teams.title AS team', 
            'allocations.start', 
            'allocations.expiry', 
        ];

        $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
            ->join('teams', 'allocations.team_id', '=', 'teams.id')
            ->select($columns)
            ->where('allocations.personal_card_id', $id)
            ->whereNull('allocations.expiry')
            ->orderBy('allocations.start', 'desc')
            ->first();

        return $result;
    }

    /**
     * Получить историю назначений 
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getManningOrderHistory($id) {
        
        $columns = [
            'departments.title AS department', 
            'positions.title AS position', 
            'position_professions.title AS profession', 
            'position_professions.code AS profession_code', 
            'resignation_date',
            'assignment_date',  
        ];

        $result = ManningOrders::join('departments', 'manning_orders.department_id', '=', 'departments.id')
            ->join('positions', 'manning_orders.position_id', '=', 'positions.id')
            ->join('position_professions', 'manning_orders.position_profession_id', '=', 'position_professions.id')
            ->select($columns)
            ->where('personal_card_id', $id)
            ->orderBy('assignment_date')
            ->get();

        return $result;
    }

    /**
     * Получить историю перемещений 
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getAllocationHistory($id) {
        
        $columns = [
            'objects.title AS object', 
            'teams.title AS team', 
            'allocations.start', 
            'allocations.expiry', 
        ];

        $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
            ->join('teams', 'allocations.team_id', '=', 'teams.id')
            ->select($columns)
            ->where('allocations.personal_card_id', $id)
            ->orderBy('allocations.start')
            ->get();

        return $result;
    }

    /**
     * Получить количество перемещений
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getManningOrderCount($id) {

        $result = ManningOrders::where('personal_card_id', $id)->count();

        return $result;
    }

    /**
     * Получить количество перемещений
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getAllocationCount($id) {

        $result = Allocations::where('personal_card_id', $id)->count();

        return $result;
    }

    /**
     * Получить список данных
     *
     * @return Collection
     */
    public function getTable() {
		
        $user = Auth::user();

        if($user['access'] == 4) {
            $result = $this->startConditions()
                ->join('personal_cards', 'teams.personal_card_id', '=', 'personal_cards.id')
                ->join('allocations', 'teams.id', '=', 'allocations.team_id')
                ->select('personal_cards.personal_account AS personal_card', 'teams.title', 'teams.abbr', 'teams.start', 'teams.expiry', 'teams.id')
                ->where('allocations.personal_card_id', $user['id'])
                ->orderBy('personal_cards.personal_account')
                ->orderBy('teams.abbr')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'teams.personal_card_id', '=', 'personal_cards.id')
                ->select('personal_cards.personal_account AS personal_card', 'teams.title', 'teams.abbr', 'teams.start', 'teams.expiry', 'teams.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('personal_cards.personal_account')
                ->orderBy('teams.abbr')
                ->get();
        } else {
            $result = $this->startConditions()
                ->join('personal_cards', 'teams.personal_card_id', '=', 'personal_cards.id')
                ->select('personal_cards.personal_account AS personal_card', 'teams.title', 'teams.abbr', 'teams.start', 'teams.expiry', 'teams.id')
                ->orderBy('personal_cards.personal_account')
                ->orderBy('teams.abbr')
                ->get();
        }

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
            ->join('personal_cards', 'teams.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'teams.title', 'teams.abbr', 'teams.start', 'teams.expiry', 'teams.id')
            ->where('teams.id', $id)
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

        $columns = ['id', 'personal_card_id', 'title', 'abbr', 'start', 'expiry', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
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
                $columns = implode(", ", ['id', 'CONCAT(personal_account, ", ", surname, ", ", first_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}