<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Teams;
use App\Models\HumanResources\Allocations;

use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Objects;

use App\Models\Accounting\BaseTimesheets as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class BaseTimesheetsRepository: Репозиторий учета отработанного времени (табель)
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class BaseTimesheetsRepository extends CoreRepository {

    /**
     * @return string
     */
    protected function getModelClass() {

        return Model::class;
    }

    /**
     * Проверка наличия табеля и его создание в случае отсутствия
     *
     * @param arr $id - идентификатор перемещения
     */
    public function getBaseTimesheet($id) {
        echo date("Y-m-d h:i:s", strtotime("now")), "</br>";
        echo date("Y-m-d h:i:s", strtotime("2020-01-05")), "</br>";
        echo date("Y-m-d h:i:s", strtotime("+1 day 2020-01-05")), "</br>";
        echo date("Y-m-d h:i:s", strtotime("+1 week")), "</br>";
        echo date("Y-m-d h:i:s", strtotime("+1 week 2 days 4 hours 2 seconds")), "</br>";
        echo date("Y-m-d h:i:s", strtotime("next Thursday")), "</br>";
        echo date("Y-m-d h:i:s", strtotime("last Monday")), "</br>";
        //Проверка наличия табелей для данного перемещения
        $first = DB::table('allocations')
            ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                    ->from('base_timesheets')
                    ->whereRaw('base_timesheets.allocation_id = allocations.id');
            })
            ->where('id', $id)
            ->get();
        
        if(count($first) > 0) {     // Табеля нет
            $update = (array)$first[0];

            $year = date("Y");
            $month = date("n");
            $day = date("d");

            $newData['allocation_id'] = $update['id'];
            for($i = 1; $i < $day; $i++) {
                $newData['hours_day_'.$i] = "-";
                $newData['rate_day_'.$i] = "-";
            }
            $newData['allocation_id'] = $update['id'];
            for($i = 1; $i < $day; $i++) {
                $newData['hours_day_'.$i] = "-";
                $newData['rate_day_'.$i] = "-";
            }
        } else {                    // Табель есть
            $year = date("Y");
            $month = date("n");
            $day = date("d");

            $update = $this->startConditions()
                ->where('allocation_id', $id)
                ->first();
            $newData['allocation_id'] = $update['allocation_id'];
            for($i = $day; $i <= 31; $i++) {
                $newData['hours_day_'.$i] = "-";
                $newData['rate_day_'.$i] = "-";
            }
        }
//        dd($result);
//        foreach ($first as $value) {
//            $result = (array)$value;
//        }
        dd($year, $month, $day, $i, $update, $newData);
//        return $result;
    }

    /**
     * Проверка списка табелей на полноту
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getTest() {
        $year = date("Y");
        $month = date("n");
        $first = DB::table('allocations')
            ->selectRaw('team_id, personal_card_id, object_id, year(start) AS start_year, month(start) AS start_month, year(expiry) AS expiry_year, month(expiry) AS expiry_month')
            ->whereYear('start', '<=', date("Y-m-d"))
            ->whereNotNull('expiry')
            ->get();
        $i = 0;
        foreach ($first as $key => $value) {
            $firstArray[] = (array)$value;
            for ($y = $firstArray[$key]['start_year']; $y <= $firstArray[$key]['expiry_year']; $y++) {
                for ($m = 1; $m <= 12; $m++) {
                    if (($y >= $firstArray[$key]['start_year'] && $m >= $firstArray[$key]['start_month']) && ($y <= $firstArray[$key]['expiry_year'] && $m <= $firstArray[$key]['expiry_month'])) {
                        $test[$i]['team_id'] = $firstArray[$key]['team_id'];
                        $test[$i]['personal_card_id'] = $firstArray[$key]['personal_card_id'];
                        $test[$i]['object_id'] = $firstArray[$key]['object_id'];
                        $test[$i]['year_id'] = $this->getYearNumer($y)['id'];
                        $test[$i]['month_id'] = $m;
                        $i++;
                    }
                }
            }
        }
        $second = DB::table('allocations')
            ->selectRaw('team_id, personal_card_id, object_id, year(start) AS start_year, month(start) AS start_month, '.$year.' AS expiry_year, '.$month.' AS expiry_month')
            ->whereYear('start', '<=', date("Y-m-d"))
            ->whereNull('expiry')
            ->get();
        foreach ($second as $key => $value) {
            $secondArray[] = (array)$value;
            for ($y = $secondArray[$key]['start_year']; $y <= $secondArray[$key]['expiry_year']; $y++) {
                for ($m = 1; $m <= 12; $m++) {
                    $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);
                    if ((date("Y-m-d", strtotime($y."-".$m."-01")) >= date("Y-m-d", strtotime($secondArray[$key]['start_year']."-".$secondArray[$key]['start_month']."-01"))) 
                            && (date("Y-m-d", strtotime($y."-".$m."-".cal_days_in_month(CAL_GREGORIAN, $m, $y))) <= date("Y-m-d", strtotime($secondArray[$key]['expiry_year']."-".$secondArray[$key]['expiry_month']."-".cal_days_in_month(CAL_GREGORIAN, $secondArray[$key]['expiry_month'], $secondArray[$key]['expiry_year']))))) {
                        $test[$i]['team_id'] = $secondArray[$key]['team_id'];
                        $test[$i]['personal_card_id'] = $secondArray[$key]['personal_card_id'];
                        $test[$i]['object_id'] = $secondArray[$key]['object_id'];
                        $test[$i]['year_id'] = $this->getYearNumer($y)['id'];
                        $test[$i]['month_id'] = $m;
                        $i++;
                    }
                }
            }
        }
        $user = Auth::user();
        foreach ($test as $key => $value) {
            $query = Model::select('id')
                ->where('team_id', $value['team_id'])
                ->where('personal_card_id', $value['personal_card_id'])
                ->where('object_id', $value['object_id'])
                ->where('year_id', $value['year_id'])
                ->where('month_id', $value['month_id'])
                ->first();
            if(!$query){
                $no[$key]['user_id'] = $user['id'];
                $no[$key]['team_id'] = $value['team_id'];
                $no[$key]['personal_card_id'] = $value['personal_card_id'];
                $no[$key]['object_id'] = $value['object_id'];
                $no[$key]['year_id'] = $value['year_id'];
                $no[$key]['month_id'] = $value['month_id'];
                $result = (new Model($no[$key]))->create($no[$key]);
            } else {
                $is[$key]['user_id'] = $user['id'];
                $is[$key]['id'] = $query['id'];
                $is[$key]['team_id'] = $value['team_id'];
                $is[$key]['personal_card_id'] = $value['personal_card_id'];
                $is[$key]['object_id'] = $value['object_id'];
                $is[$key]['year_id'] = $value['year_id'];
                $is[$key]['month_id'] = $value['month_id'];
            }
        }
        
//        $result = (new BaseTimesheets($newData))->create($newData);
//        dd($no, $is, $test);
//        dd($i, $test, $secondArray);
//        dd($test, $first, $second);
//        return $result;
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
            $result = Model::join('teams', 'base_timesheets.team_id', '=', 'teams.id')
                    ->join('years', 'base_timesheets.year_id', '=', 'years.id')
                    ->join('months', 'base_timesheets.month_id', '=', 'months.id')
                    ->select('base_timesheets.year_id', 'base_timesheets.month_id', 'teams.title AS team', 'years.number AS year', 'months.title AS month', 'teams.id AS team_id', DB::raw('SUM(base_timesheets.hourly) as hourly, SUM(base_timesheets.piecework) as piecework, SUM(base_timesheets.total) as total'))
                    ->where('base_timesheets.personal_card_id', $user['id'])
                    ->groupBy('base_timesheets.year_id')
                    ->groupBy('base_timesheets.month_id')
                    ->groupBy('teams.title')
                    ->groupBy('years.number')
                    ->groupBy('months.title')
                    ->groupBy('teams.id')
                    ->orderBy('base_timesheets.year_id')
                    ->orderBy('base_timesheets.month_id')
                    ->orderBy('teams.title')
                    ->get();
        } elseif($user['access'] == 3) {
            $result = Model::join('teams', 'base_timesheets.team_id', '=', 'teams.id')
                    ->join('years', 'base_timesheets.year_id', '=', 'years.id')
                    ->join('months', 'base_timesheets.month_id', '=', 'months.id')
                    ->select('base_timesheets.year_id', 'base_timesheets.month_id', 'teams.title AS team', 'years.number AS year', 'months.title AS month', 'teams.id AS team_id', DB::raw('SUM(base_timesheets.hourly) as hourly, SUM(base_timesheets.piecework) as piecework, SUM(base_timesheets.total) as total'))
                    ->where('teams.personal_card_id', $user['id'])
                    ->groupBy('base_timesheets.year_id')
                    ->groupBy('base_timesheets.month_id')
                    ->groupBy('teams.title')
                    ->groupBy('years.number')
                    ->groupBy('months.title')
                    ->groupBy('teams.id')
                    ->orderBy('base_timesheets.year_id')
                    ->orderBy('base_timesheets.month_id')
                    ->orderBy('teams.title')
                    ->get();
        } else {
            $result = Model::join('teams', 'base_timesheets.team_id', '=', 'teams.id')
                    ->join('years', 'base_timesheets.year_id', '=', 'years.id')
                    ->join('months', 'base_timesheets.month_id', '=', 'months.id')
                    ->select('base_timesheets.year_id', 'base_timesheets.month_id', 'teams.title AS team', 'years.number AS year', 'months.title AS month', 'teams.id AS team_id', DB::raw('SUM(base_timesheets.hourly) as hourly, SUM(base_timesheets.piecework) as piecework, SUM(base_timesheets.total) as total'))
                    ->groupBy('base_timesheets.year_id')
                    ->groupBy('base_timesheets.month_id')
                    ->groupBy('teams.title')
                    ->groupBy('years.number')
                    ->groupBy('months.title')
                    ->groupBy('teams.id')
                    ->orderBy('base_timesheets.year_id')
                    ->orderBy('base_timesheets.month_id')
                    ->orderBy('teams.title')
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
            ->join('personal_cards', 'base_timesheets.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'base_timesheets.year_id', '=', 'years.id')
            ->join('months', 'base_timesheets.month_id', '=', 'months.id')
            ->join('objects', 'base_timesheets.object_id', '=', 'objects.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'base_timesheets.day_1', 'base_timesheets.day_2', 'base_timesheets.day_3', 'base_timesheets.day_4', 'base_timesheets.day_5', 'base_timesheets.day_6', 'base_timesheets.day_7', 'base_timesheets.day_8', 'base_timesheets.day_9', 'base_timesheets.day_10', 'base_timesheets.day_11', 'base_timesheets.day_12', 'base_timesheets.day_13', 'base_timesheets.day_14', 'base_timesheets.day_15', 'base_timesheets.day_16', 'base_timesheets.day_17', 'base_timesheets.day_18', 'base_timesheets.day_19', 'base_timesheets.day_20', 'base_timesheets.day_21', 'base_timesheets.day_22', 'base_timesheets.day_23', 'base_timesheets.day_24', 'base_timesheets.day_25', 'base_timesheets.day_26', 'base_timesheets.day_27', 'base_timesheets.day_28', 'base_timesheets.day_29', 'base_timesheets.day_30', 'base_timesheets.day_31', 'base_timesheets.hours', 'base_timesheets.rate', 'base_timesheets.hourly', 'base_timesheets.piecework', 'base_timesheets.return_fix', 'base_timesheets.retention_fix', 'base_timesheets.penalty', 'base_timesheets.prepaid_expense', 'base_timesheets.food', 'base_timesheets.work_clothes', 'base_timesheets.total', 'base_timesheets.id')
            ->where('base_timesheets.id', $id)
            ->toBase()
            ->first();

        return $result;
    }

    /**
     * Получить модель для редактирования данных группы записей
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($team, $year, $month) {

        $columns = [
            'base_timesheets.id', 
            'base_timesheets.user_id', 
            'base_timesheets.team_id', 
            'base_timesheets.personal_card_id', 
            'base_timesheets.year_id', 
            'base_timesheets.month_id', 
            'base_timesheets.object_id', 
            'base_timesheets.hours_day_1', 
            'base_timesheets.hours_day_2', 
            'base_timesheets.hours_day_3', 
            'base_timesheets.hours_day_4', 
            'base_timesheets.hours_day_5', 
            'base_timesheets.hours_day_6', 
            'base_timesheets.hours_day_7', 
            'base_timesheets.hours_day_8', 
            'base_timesheets.hours_day_9', 
            'base_timesheets.hours_day_10', 
            'base_timesheets.hours_day_11', 
            'base_timesheets.hours_day_12', 
            'base_timesheets.hours_day_13', 
            'base_timesheets.hours_day_14', 
            'base_timesheets.hours_day_15', 
            'base_timesheets.hours_day_16', 
            'base_timesheets.hours_day_17', 
            'base_timesheets.hours_day_18', 
            'base_timesheets.hours_day_19', 
            'base_timesheets.hours_day_20', 
            'base_timesheets.hours_day_21', 
            'base_timesheets.hours_day_22', 
            'base_timesheets.hours_day_23', 
            'base_timesheets.hours_day_24', 
            'base_timesheets.hours_day_25', 
            'base_timesheets.hours_day_26', 
            'base_timesheets.hours_day_27', 
            'base_timesheets.hours_day_28', 
            'base_timesheets.hours_day_29', 
            'base_timesheets.hours_day_30', 
            'base_timesheets.hours_day_31', 
            'base_timesheets.rate_day_1', 
            'base_timesheets.rate_day_2', 
            'base_timesheets.rate_day_3', 
            'base_timesheets.rate_day_4', 
            'base_timesheets.rate_day_5', 
            'base_timesheets.rate_day_6', 
            'base_timesheets.rate_day_7', 
            'base_timesheets.rate_day_8', 
            'base_timesheets.rate_day_9', 
            'base_timesheets.rate_day_10', 
            'base_timesheets.rate_day_11', 
            'base_timesheets.rate_day_12', 
            'base_timesheets.rate_day_13', 
            'base_timesheets.rate_day_14', 
            'base_timesheets.rate_day_15', 
            'base_timesheets.rate_day_16', 
            'base_timesheets.rate_day_17', 
            'base_timesheets.rate_day_18', 
            'base_timesheets.rate_day_19', 
            'base_timesheets.rate_day_20', 
            'base_timesheets.rate_day_21', 
            'base_timesheets.rate_day_22', 
            'base_timesheets.rate_day_23', 
            'base_timesheets.rate_day_24', 
            'base_timesheets.rate_day_25', 
            'base_timesheets.rate_day_26', 
            'base_timesheets.rate_day_27', 
            'base_timesheets.rate_day_28', 
            'base_timesheets.rate_day_29', 
            'base_timesheets.rate_day_30', 
            'base_timesheets.rate_day_31', 
            'base_timesheets.hours', 
            'base_timesheets.rate', 
            'base_timesheets.hourly', 
            'base_timesheets.piecework', 
            'base_timesheets.return_fix', 
            'base_timesheets.retention_fix', 
            'base_timesheets.penalty', 
            'base_timesheets.prepaid_expense', 
            'base_timesheets.food', 
            'base_timesheets.work_clothes', 
            'base_timesheets.total', 
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
            ->join('objects', 'base_timesheets.object_id', '=', 'objects.id')
            ->join('teams', 'base_timesheets.team_id', '=', 'teams.id')
            ->join('personal_cards', 'base_timesheets.personal_card_id', '=', 'personal_cards.id')
            ->join('manning_orders', 'base_timesheets.personal_card_id', '=', 'manning_orders.personal_card_id')
            ->join('departments', 'manning_orders.department_id', '=', 'departments.id')
            ->select($columns)
            ->where('base_timesheets.team_id', $team)
            ->where('base_timesheets.year_id', $year)
            ->where('base_timesheets.month_id', $month)
            ->orderBy('departments.title')
            ->orderBy('teams.title')
            ->orderBy('personal_cards.surname')
            ->orderBy('personal_cards.first_name')
            ->orderBy('personal_cards.second_name')
            ->orderBy('objects.abbr')
            ->distinct()
            ->get();
//        dd($result);
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