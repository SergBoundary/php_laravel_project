<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards as Model;
use App\Models\HumanResources\Allocations;
use App\Models\HumanResources\ManningOrders;
use App\Models\HumanResources\Teams;

use App\Models\References\Departments;
use App\Models\References\Positions;
use App\Models\References\PositionProfessions;
use App\Models\References\Objects;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class PersonalCardsRepository: Репозиторий учета неизменяемых персональных данных
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class PersonalCardsRepository extends CoreRepository {

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
                ->select('personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.born_date', 'personal_cards.id')
                ->where('personal_cards.id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('allocations', 'personal_cards.id', '=', 'allocations.personal_card_id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.born_date', 'personal_cards.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->get();
        } else {
            $result = $this->startConditions()
                ->select('personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.born_date', 'personal_cards.id')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->get();
        }

        return $result;
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

        $result = $this->startConditions()
            ->select($columns)
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
            'manning_orders.department_id', 
            'manning_orders.position_id', 
            'manning_orders.position_profession_id', 
            'manning_orders.assignment_date', 
            'manning_orders.resignation_date', 
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
            'allocations.object_id',
            'allocations.team_id', 
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
     * Получить модель для представления данных одной записи
     *
     * @param int $id
     *
     * @return Model
     */
    public function getShow($id) {

        $result = $this->startConditions()
            ->select('personal_cards.personal_account', 'personal_cards.tax_number', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.second_name', 'personal_cards.full_name_latina', 'personal_cards.sex', 'personal_cards.born_date', 'personal_cards.photo_url', 'personal_cards.id')
            ->where('personal_cards.id', $id)
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

        $columns = ['id', 'personal_account', 'surname', 'first_name', 'second_name', 'full_name_latina', 'sex', 'born_date', 'phone', 'photo_url', ];

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
            case 1:
                $columns = implode(", ", ['id', 'abbr AS department']);
                $result = Departments::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS position']);
                $result = Positions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'CONCAT(title, " (", code, ")") AS position_profession']);
                $result = PositionProfessions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'title AS team']);
                $result = Teams::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'title AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}