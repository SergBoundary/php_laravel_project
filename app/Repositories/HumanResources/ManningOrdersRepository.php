<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Departments;
use App\Models\References\Positions;
use App\Models\References\PositionProfessions;
use App\Models\Settings\Users;
use App\Models\HumanResources\ManningOrders as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class ManningOrdersRepository: Репозиторий учета должностных назначений
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class ManningOrdersRepository extends CoreRepository {

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
                ->join('personal_cards', 'manning_orders.personal_card_id', '=', 'personal_cards.id')
                ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
                ->join('positions', 'manning_orders.position_id', '=', 'positions.id')
                ->join('position_professions', 'manning_orders.position_profession_id', '=', 'position_professions.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'departments.abbr AS department', 'positions.title AS position', 'position_professions.code AS position_profession', 'manning_orders.assignment_date', 'manning_orders.resignation_date', 'manning_orders.id')
                ->where('personal_cards.id', $user['id'])
                ->orderBy('departments.abbr')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('manning_orders.assignment_date')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'manning_orders.personal_card_id', '=', 'personal_cards.id')
                ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
                ->join('positions', 'manning_orders.position_id', '=', 'positions.id')
                ->join('position_professions', 'manning_orders.position_profession_id', '=', 'position_professions.id')
                ->join('allocations', 'personal_cards.id', '=', 'allocations.personal_card_id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'departments.abbr AS department', 'positions.title AS position', 'position_professions.code AS position_profession', 'manning_orders.assignment_date', 'manning_orders.resignation_date', 'manning_orders.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('departments.abbr')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('manning_orders.assignment_date')
                ->get();
        } else {
            $result = $this->startConditions()
                ->join('personal_cards', 'manning_orders.personal_card_id', '=', 'personal_cards.id')
                ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
                ->join('positions', 'manning_orders.position_id', '=', 'positions.id')
                ->join('position_professions', 'manning_orders.position_profession_id', '=', 'position_professions.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'departments.abbr AS department', 'positions.title AS position', 'position_professions.code AS position_profession', 'manning_orders.assignment_date', 'manning_orders.resignation_date', 'manning_orders.id')
                ->orderBy('departments.abbr')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('manning_orders.assignment_date')
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
     * Получить данные о назначении 
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getManningOrder($id) {
        
        $columns = [
            'departments.title AS department', 
            'positions.title AS position', 
            'position_professions.title AS profession', 
            'position_professions.code AS profession_code', 
            'manning_orders.id',
            'manning_orders.user_id',
            'manning_orders.personal_card_id',
            'manning_orders.department_id', 
            'manning_orders.position_id', 
            'manning_orders.position_profession_id', 
            'manning_orders.assignment_date', 
            'manning_orders.resignation_date', 
        ];

        $result = $this->startConditions()
                ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
                ->join('positions', 'manning_orders.position_id', '=', 'positions.id')
                ->join('position_professions', 'manning_orders.position_profession_id', '=', 'position_professions.id')
                ->select($columns)
                ->where('manning_orders.id', $id)
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
            ->join('personal_cards', 'manning_orders.personal_card_id', '=', 'personal_cards.id')
            ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
            ->join('positions', 'manning_orders.position_id', '=', 'positions.id')
            ->join('position_professions', 'manning_orders.position_profession_id', '=', 'position_professions.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'departments.abbr AS department', 'positions.title AS position', 'position_professions.code AS position_profession', 'position_professions.title AS position_profession_title', 'manning_orders.assignment_date', 'manning_orders.resignation_date', 'manning_orders.id')
            ->where('manning_orders.id', $id)
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

        $columns = ['id', 'user_id', 'personal_card_id', 'department_id', 'position_id', 'position_profession_id', 'assignment_date', 'resignation_date', ];

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
                $columns = implode(", ", ['id', 'CONCAT(surname, " ", first_name, " ", second_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
                    ->orderBy('surname')
                    ->orderBy('first_name')
                    ->orderBy('second_name')
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
        }

        return $result;
    }

}