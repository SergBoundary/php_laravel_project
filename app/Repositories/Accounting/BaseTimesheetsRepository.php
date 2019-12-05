<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Objects;
use App\Models\Accounting\BaseTimesheets as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

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
                ->join('personal_cards', 'base_timesheets.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'base_timesheets.year_id', '=', 'years.id')
                ->join('months', 'base_timesheets.month_id', '=', 'months.id')
                ->join('objects', 'base_timesheets.object_id', '=', 'objects.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'base_timesheets.hourly', 'base_timesheets.piecework', 'base_timesheets.total', 'base_timesheets.id')
                ->where('personal_cards.id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('base_timesheets.hourly')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'base_timesheets.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'base_timesheets.year_id', '=', 'years.id')
                ->join('months', 'base_timesheets.month_id', '=', 'months.id')
                ->join('objects', 'base_timesheets.object_id', '=', 'objects.id')
                ->join('allocations', 'personal_cards.id', '=', 'allocations.personal_card_id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'base_timesheets.hourly', 'base_timesheets.piecework', 'base_timesheets.total', 'base_timesheets.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('base_timesheets.hourly')
                ->get();
        } else {
            $result = $this->startConditions()
                ->join('personal_cards', 'base_timesheets.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'base_timesheets.year_id', '=', 'years.id')
                ->join('months', 'base_timesheets.month_id', '=', 'months.id')
                ->join('objects', 'base_timesheets.object_id', '=', 'objects.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'base_timesheets.hourly', 'base_timesheets.piecework', 'base_timesheets.total', 'base_timesheets.id')
                ->orderBy('personal_cards.surname')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('base_timesheets.hourly')
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
     * Получить модель для редактирования данных одной записи
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id) {

        $columns = ['id', 'personal_card_id', 'year_id', 'month_id', 'object_id', 'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7', 'day_8', 'day_9', 'day_10', 'day_11', 'day_12', 'day_13', 'day_14', 'day_15', 'day_16', 'day_17', 'day_18', 'day_19', 'day_20', 'day_21', 'day_22', 'day_23', 'day_24', 'day_25', 'day_26', 'day_27', 'day_28', 'day_29', 'day_30', 'day_31', 'hours', 'rate', 'hourly', 'piecework', 'return_fix', 'retention_fix', 'penalty', 'prepaid_expense', 'food', 'work_clothes', 'total', ];

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