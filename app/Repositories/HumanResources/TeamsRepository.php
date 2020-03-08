<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Allocations;
use App\Models\HumanResources\ManningOrders;
use App\Models\Settings\Users;
use App\Models\HumanResources\Teams as Model;

use App\Models\References\Departments;
use App\Models\References\Positions;
use App\Models\References\PositionProfessions;
use App\Models\References\Objects;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class TeamsRepository: Репозиторий учета формирования бригад
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class TeamsRepository extends CoreRepository {

    /**
     * @return string
     */
    protected function getModelClass() {

        return Model::class;
    }

    /**
     * Получить список групп
     *
     * @param arr $id
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
                ->distinct()
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
     * Получить данные о группе
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getTeam($id) {

        $columns = [
            'teams.id',
            'user_id',
            'personal_card_id',
            'title', 
            'abbr', 
            'start', 
            'expiry',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

    /**
     * Получить персональные данные руководителя группы
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getLeader($id) {

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
     * Получить данные об авторе записи о группе
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
     * Получить данные о последнем назначении 
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getLeaderManningOrderActuality($id) {
        
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
     * Получить данные о текущих объектах в работе 
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getObject($id, $lead) {
        
        $columns = [
            'objects.title AS object',  
            'teams.title AS team', 
            'allocations.object_id',
            'allocations.team_id', 
            'allocations.start', 
            'allocations.expiry', 
        ];
        
        $team = $this->startConditions()
            ->whereNotNull('expiry')
            ->find($id);
        
        if($team) {
            $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select($columns)
                ->where('allocations.expiry', $team['expiry'])
                ->where('allocations.personal_card_id', $lead)
                ->orderBy('allocations.start')
                ->distinct()
                ->get();
        } else {
            $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select($columns)
                ->where('allocations.personal_card_id', $lead)
                ->whereNull('allocations.expiry')
                ->orderBy('allocations.start')
                ->distinct()
                ->get();
        }

        return $result;
    }

    /**
     * Получить количество перемещений
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getObjectCount($id, $lead) {
        
        $team = $this->startConditions()
            ->whereNotNull('expiry')
            ->find($id);
        
        if($team) {
            $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->where('allocations.expiry', $team['expiry'])
                ->where('allocations.personal_card_id', $lead)
                ->count();
        } else {
            $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->where('allocations.personal_card_id', $lead)
                ->whereNull('allocations.expiry')
                ->count();
        }

        return $result;
    }

    /**
     * Получить данные об участниках группы
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getPeople($id, $lead) {
        
        $columns = [
            'personal_cards.id',
            'personal_cards.personal_account', 
            'personal_cards.surname', 
            'personal_cards.first_name', 
            'personal_cards.second_name', 
            'objects.title AS object', 
            'allocations.user_id', 
            'allocations.personal_card_id',
            'allocations.object_id',
            'allocations.team_id', 
            'allocations.start', 
            'allocations.expiry', 
        ];
        
        $team = $this->startConditions()
            ->whereNotNull('expiry')
            ->find($id);
        
        if($team) {
            if($lead == 0) {
                $result = Allocations::where('team_id', $id)
                    ->whereNull('allocations.expiry')
                    ->orderBy('allocations.id')
                    ->get();
                dd($id, $lead);
            } else {
                $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                    ->join('teams', 'allocations.team_id', '=', 'teams.id')
                    ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                    ->select($columns)
                    ->where('teams.id', $id)
                    ->where('allocations.expiry', $team['expiry'])
                    ->where('allocations.personal_card_id', '!=', $lead)
                    ->orderBy('personal_cards.surname')
                    ->orderBy('personal_cards.first_name')
                    ->orderBy('personal_cards.second_name')
                    ->orderBy('allocations.start')
                    ->get();
            }
        } else {
            $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                ->select($columns)
                ->where('teams.id', $id)
                ->where('allocations.personal_card_id', '!=', $lead)
                ->whereNull('allocations.expiry')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('personal_cards.second_name')
                ->orderBy('allocations.start')
                ->get();
        }
//        dd($result);
        return $result;
    }

    /**
     * Получить данные об участниках группы для редактирования
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getAllPeople($id) {
        
        $result = Allocations::where('team_id', $id)
            ->whereNull('expiry')
            ->get();

        return $result;
    }

    /**
     * Открепить сотрудников от расформировываемой бригады
     *
     * @param integer $id - ID of allocation, date $expiry - date of close team
     *
     * @return Collection
     */
    public function getCloseTeam($id, $expiry) {
        
        $result = Allocations::where('id', $id)
            ->whereNull('expiry')
            ->first();
        
        $result->expiry = $expiry;
        $result->save();

        return $result;
    }

    /**
     * Открепить сотрудников от расформировываемой бригады
     *
     * @param integer $teamId - ID of new team, integer $rowId - ID of old allocation
     * date $start - date of create team, integer $userId - ID of user
     *
     * @return Collection
     */
    public function getMovingPeople($teamId, $personalId, $objectId, $start, $userId) {
        
        $newData['user_id'] = $userId;
        $newData['personal_card_id'] = $personalId;
        $newData['object_id'] = $objectId;
        $newData['team_id'] = $teamId;
        $newData['start'] = $start;
        $newData['expiry'] = null;
        
        $result = Allocations::create($newData);

        return $result;
    }

    /**
     * Получить количество перемещений
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getPeopleCount($id, $lead) {
        
        $team = $this->startConditions()
            ->whereNotNull('expiry')
            ->find($id);
        
        if($team) {
            $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                ->where('teams.id', $id)
                ->where('allocations.expiry', $team['expiry'])
                ->where('allocations.personal_card_id', '!=', $lead)
                ->count();
        } else {
            $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                ->where('teams.id', $id)
                ->where('allocations.personal_card_id', '!=', $lead)
                ->whereNull('allocations.expiry')
                ->count();
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

        $columns = ['id', 'user_id', 'personal_card_id', 'title', 'abbr', 'start', 'expiry', ];

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
            case 4:
                $columns = implode(", ", ['id', 'title AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}