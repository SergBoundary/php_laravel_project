<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Teams;
use App\Models\HumanResources\Allocations;

use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Objects;

use App\Models\Accounting\Pieceworks as Model;
use App\Models\Accounting\BaseTimesheets;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class PieceworksRepository: Репозиторий учета сдельных работ
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class PieceworksRepository extends CoreRepository {

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
            $result = Model::join('teams', 'pieceworks.team_id', '=', 'teams.id')
                    ->join('years', 'pieceworks.year_id', '=', 'years.id')
                    ->join('months', 'pieceworks.month_id', '=', 'months.id')
                    ->select('pieceworks.year_id', 'pieceworks.month_id', 'teams.title AS team', 'years.number AS year', 'months.title AS month', 'teams.id AS team_id', DB::raw('COUNT(pieceworks.personal_card_id) as count, SUM(pieceworks.quantity * pieceworks.price) as total'))
                    ->where('pieceworks.personal_card_id', $user['id'])
                    ->groupBy('pieceworks.year_id')
                    ->groupBy('pieceworks.month_id')
                    ->groupBy('teams.title')
                    ->groupBy('years.number')
                    ->groupBy('months.title')
                    ->groupBy('teams.id')
                    ->orderBy('pieceworks.year_id')
                    ->orderBy('pieceworks.month_id')
                    ->orderBy('teams.title')
                    ->get();
        } elseif($user['access'] == 3) {
            $result = Model::join('teams', 'pieceworks.team_id', '=', 'teams.id')
                    ->join('years', 'pieceworks.year_id', '=', 'years.id')
                    ->join('months', 'pieceworks.month_id', '=', 'months.id')
                    ->select('pieceworks.year_id', 'pieceworks.month_id', 'teams.title AS team', 'years.number AS year', 'months.title AS month', 'teams.id AS team_id', DB::raw('COUNT(pieceworks.personal_card_id) as count, SUM(pieceworks.quantity * pieceworks.price) as total'))
                    ->where('teams.personal_card_id', $user['id'])
                    ->groupBy('pieceworks.year_id')
                    ->groupBy('pieceworks.month_id')
                    ->groupBy('teams.title')
                    ->groupBy('years.number')
                    ->groupBy('months.title')
                    ->groupBy('teams.id')
                    ->orderBy('pieceworks.year_id')
                    ->orderBy('pieceworks.month_id')
                    ->orderBy('teams.title')
                    ->get();
        } else {
            $result = Model::join('teams', 'pieceworks.team_id', '=', 'teams.id')
                    ->join('years', 'pieceworks.year_id', '=', 'years.id')
                    ->join('months', 'pieceworks.month_id', '=', 'months.id')
                    ->select('pieceworks.year_id', 'pieceworks.month_id', 'teams.title AS team', 'years.number AS year', 'months.title AS month', 'teams.id AS team_id', DB::raw('COUNT(pieceworks.personal_card_id) as count, SUM(pieceworks.quantity * pieceworks.price) as total'))
                    ->groupBy('pieceworks.year_id')
                    ->groupBy('pieceworks.month_id')
                    ->groupBy('teams.title')
                    ->groupBy('years.number')
                    ->groupBy('months.title')
                    ->groupBy('teams.id')
                    ->orderBy('pieceworks.year_id')
                    ->orderBy('pieceworks.month_id')
                    ->orderBy('teams.title')
                    ->get();
        }
//        dd($result);
        return $result;
		
        $user = Auth::user();

        if($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'pieceworks.year_id', '=', 'years.id')
                ->join('months', 'pieceworks.month_id', '=', 'months.id')
                ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'pieceworks.type', 'pieceworks.unit', 'pieceworks.quantity', 'pieceworks.price', 'pieceworks.id')
                ->where('personal_cards.id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('pieceworks.type')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'pieceworks.year_id', '=', 'years.id')
                ->join('months', 'pieceworks.month_id', '=', 'months.id')
                ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
                ->join('allocations', 'personal_cards.id', '=', 'allocations.personal_card_id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'pieceworks.type', 'pieceworks.unit', 'pieceworks.quantity', 'pieceworks.price', 'pieceworks.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('pieceworks.type')
                ->get();
        } else {
            $result = $this->startConditions()
                ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'pieceworks.year_id', '=', 'years.id')
                ->join('months', 'pieceworks.month_id', '=', 'months.id')
                ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'pieceworks.type', 'pieceworks.unit', 'pieceworks.quantity', 'pieceworks.price', 'pieceworks.id')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('pieceworks.type')
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
            ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'pieceworks.year_id', '=', 'years.id')
            ->join('months', 'pieceworks.month_id', '=', 'months.id')
            ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'pieceworks.type', 'pieceworks.unit', 'pieceworks.quantity', 'pieceworks.price', 'pieceworks.id')
            ->where('pieceworks.id', $id)
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
    public function getEdit($team, $year, $month) {

        $columns = [ 
            'pieceworks.id', 
            'pieceworks.user_id', 
            'pieceworks.team_id', 
            'pieceworks.personal_card_id', 
            'pieceworks.year_id', 
            'pieceworks.month_id', 
            'pieceworks.object_id', 
            'pieceworks.type', 
            'pieceworks.unit', 
            'pieceworks.quantity', 
            'pieceworks.price', 
            'pieceworks.total', 
            'personal_cards.id AS personal_card_id', 
            'personal_cards.personal_account', 
            'personal_cards.surname', 
            'personal_cards.first_name', 
            'personal_cards.second_name', 
            'teams.id AS team_id', 
            'teams.title AS team_title', 
            'teams.abbr AS team_abbr', 
            'objects.id AS object_id', 
            'objects.title AS object_title', 
            'objects.abbr AS object_abbr', 
            'departments.id AS department_id', 
            'departments.title AS department_title', 
            'departments.abbr AS department_abbr'
        ];

        $result = $this->startConditions()
            ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
            ->join('teams', 'pieceworks.team_id', '=', 'teams.id')
            ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
            ->join('manning_orders', 'pieceworks.personal_card_id', '=', 'manning_orders.personal_card_id')
            ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
            ->select($columns)
            ->where('pieceworks.team_id', $team)
            ->where('pieceworks.year_id', $year)
            ->where('pieceworks.month_id', $month)
            ->orderBy('departments.title')
            ->orderBy('teams.title')
            ->orderBy('personal_cards.surname')
            ->orderBy('personal_cards.first_name')
            ->orderBy('personal_cards.second_name')
            ->orderBy('objects.abbr')
            ->distinct()
            ->get();

        return $result;
    }

    /**
     * Получить модель для записи измененных данных группы записей
     *
     * @param int $id
     *
     * @return Model
     */
    public function getUpdate($id) {

        $result = $this->startConditions()
            ->where('id', $id)
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
    public function getCreate($id, $year, $month) {
		
        $user = Auth::user();
        $start = $year."-".$month."-".cal_days_in_month (CAL_GREGORIAN, $month, $year );
        $expiry = $year."-".$month."-01";
        
        if($id != 0) {
            // Отбор id по первому условию
            $first = DB::table('allocations')
                ->select('id')
                ->where('team_id', $id)
                ->where('start', '<=', $start)
                ->where('expiry', '>=', $expiry);
            // Отбор id по второму условию
            $second = DB::table('allocations')
                ->select('id')
                ->where('team_id', $id)
                ->where('start', '<=', $start)
                ->whereNull('expiry')
                ->union($first)
                ->get();
            // Объединение id в один список
            $list = $second->union($first);
            // Отбор данных по списку id
            if(count($second)>0) {
                foreach ($second as $value) {
                    $val = (array)$value;
                    $in[] = $val['id'];
                }
                $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                    ->join('teams', 'allocations.team_id', '=', 'teams.id')
                    ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                    ->join('manning_orders', 'allocations.personal_card_id', '=', 'manning_orders.personal_card_id')
                    ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
                    ->select('allocations.id', 'allocations.start', 'allocations.expiry', 'personal_cards.id AS personal_card_id', 'personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.second_name', 'teams.id AS team_id', 'teams.title AS team_title', 'teams.abbr AS team_abbr', 'objects.id AS object_id', 'objects.title AS object_title', 'objects.abbr AS object_abbr', 'departments.id AS department_id', 'departments.title AS department_title', 'departments.abbr AS department_abbr')
                    ->whereIn('allocations.id', $in)
                    ->whereNull('manning_orders.resignation_date')
                    ->orderBy('departments.title')
                    ->orderBy('teams.title')
                    ->orderBy('personal_cards.surname')
                    ->orderBy('personal_cards.first_name')
                    ->orderBy('personal_cards.second_name')
                    ->orderBy('objects.abbr')
                    ->get();
            } else {
                $result = Allocations::select('id')
                    ->where('id', 0)
                    ->get();
            }
        } elseif($id == 0) {
            // Отбор id по первому условию
            $first = DB::table('allocations')
                ->select('id')
                ->where('start', '<=', $start)
                ->where('expiry', '>=', $expiry);
            // Отбор id по второму условию и объединение id в один список
            $second = DB::table('allocations')
                ->select('id')
                ->where('start', '<=', $start)
                ->whereNull('expiry')
                ->union($first)
                ->get();
            // Отбор данных по списку id
            if(count($second)>0) {
                foreach ($second as $value) {
                    $val = (array)$value;
                    $in[] = $val['id'];
                }
                $result = Allocations::join('objects', 'allocations.object_id', '=', 'objects.id')
                    ->join('teams', 'allocations.team_id', '=', 'teams.id')
//                    ->join('pieceworks', 'allocations.team_id', '=', 'pieceworks.team_id')
//                    ->join('pieceworks', 'allocations.year_id', '=', 'pieceworks.year_id')
//                    ->join('pieceworks', 'allocations.month_id', '=', 'pieceworks.month_id')
                    ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
                    ->join('manning_orders', 'allocations.personal_card_id', '=', 'manning_orders.personal_card_id')
                    ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
                    ->select('allocations.id', 'allocations.start', 'allocations.expiry', 'personal_cards.id AS personal_card_id', 'personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.second_name', 'teams.id AS team_id', 'teams.title AS team_title', 'teams.abbr AS team_abbr', 'objects.id AS object_id', 'objects.title AS object_title', 'objects.abbr AS object_abbr', 'departments.id AS department_id', 'departments.title AS department_title', 'departments.abbr AS department_abbr')
                    ->whereIn('allocations.id', $in)
                    ->whereNull('manning_orders.resignation_date')
                    ->orderBy('departments.title')
                    ->orderBy('teams.title')
                    ->orderBy('personal_cards.surname')
                    ->orderBy('personal_cards.first_name')
                    ->orderBy('personal_cards.second_name')
                    ->orderBy('objects.abbr')
                    ->get();
            } else {
                $result = Allocations::select('id')
                    ->where('id', 0)
                    ->get();
            }
        }
        
        return $result;
    }

    /**
     * Получить модель для записи измененных данных группы записей
     *
     * @param int $id
     *
     * @return Model
     */
    public function getBaseTimesheets($team, $personalCard, $object, $year, $month) {

        $result = BaseTimesheets::where('team_id', $team)
            ->where('personal_card_id', $personalCard)
            ->where('object_id', $object)
            ->where('year_id', $year)
            ->where('month_id', $month)
            ->first();

        return $result;
    }

    /**
     * Получить данные группы
     *
     * @param int $id
     *
     * @return Model
     */
    public function getTeam($id) {
        
        $result = Teams::find($id);

        return $result;
    }

    /**
     * Получить данные группы
     *
     * @param int $id
     *
     * @return Model
     */
    public function getTeamLeader($id) {
        
        $result = Teams::select('id')
                ->where('personal_card_id', $id)
                ->first();
        
        return $result;
    }

    /**
     * Получить данные группы
     *
     * @param int $id
     *
     * @return Model
     */
    public function getTeamwWorker($id) {
        
        $result = Allocations::select('team_id')
                ->where('personal_card_id', $id)
                ->first();
        
        return $result;
    }

    /**
     * Получить данные года
     *
     * @param int $id
     *
     * @return Model
     */
    public function getYear($id) {
        
        $result = Years::find($id);

        return $result;
    }

    /**
     * Получить данные года
     *
     * @param int $id
     *
     * @return Model
     */
    public function getYearNumer($number) {
        
        $result = Years::where('number', $number)->first();

        return $result;
    }

    /**
     * Получить данные месяца
     *
     * @param int $id
     *
     * @return Model
     */
    public function getMonth($id) {
        
        $result = Months::find($id);

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
                $user = Auth::user();

                if($user['access'] == 4) {
                    $result = FALSE;
                } elseif($user['access'] == 3) {
                    $result = PersonalCards::join('allocations', 'personal_cards.id', '=', 'allocations.personal_card_id')
                        ->join('teams', 'allocations.team_id', '=', 'teams.id')
                        ->select('personal_cards.id', 'personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name')
                        ->where('teams.personal_card_id', $user['id'])
                        ->distinct()
                        ->toBase()
                        ->get();
                } else {
                    $result = PersonalCards::select('personal_cards.id', 'personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name')
                        ->distinct()
                        ->toBase()
                        ->get();
                }
                break;
            case 1:
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();
                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();
                break;
            case 3:
                $columns = implode(", ", ['id', 'title AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();
                break;
        }

        return $result;
    }

}