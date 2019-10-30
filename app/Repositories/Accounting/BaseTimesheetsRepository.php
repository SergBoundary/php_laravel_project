<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Accruals;
use App\Models\References\HoursBalanceClassifiers;
use App\Models\References\Departments;
use App\Models\References\Accounts;
use App\Models\References\Positions;
use App\Models\References\Objects;
use App\Models\Accounting\BaseTimesheets as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

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

        $result = $this->startConditions()
            ->join('personal_cards', 'base_timesheets.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'base_timesheets.year_id', '=', 'years.id')
            ->join('months', 'base_timesheets.month_id', '=', 'months.id')
            ->join('accruals', 'base_timesheets.accrual_id', '=', 'accruals.id')
            ->join('hours_balance_classifiers', 'base_timesheets.hours_balance_classifier_id', '=', 'hours_balance_classifiers.id')
            ->join('departments', 'base_timesheets.department_id', '=', 'departments.id')
            ->join('accounts', 'base_timesheets.account_id', '=', 'accounts.id')
            ->join('positions', 'base_timesheets.position_id', '=', 'positions.id')
            ->join('objects', 'base_timesheets.object_id', '=', 'objects.id')
            ->select('personal_cards.personal_account AS personal_card', 'years.number AS year', 'months.number AS month', 'accruals.title AS accrual', 'hours_balance_classifiers.title AS hours_balance_classifier', 'departments.abbr AS department', 'accounts.title AS account', 'positions.subordination_id AS position', 'objects.abbr AS object', 'base_timesheets.actual_days', 'base_timesheets.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('accruals.title')
            ->orderBy('hours_balance_classifiers.title')
            ->orderBy('departments.abbr')
            ->orderBy('accounts.title')
            ->orderBy('positions.subordination_id')
            ->orderBy('objects.abbr')
            ->orderBy('base_timesheets.actual_days')
            ->get();
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
            ->join('accruals', 'base_timesheets.accrual_id', '=', 'accruals.id')
            ->join('hours_balance_classifiers', 'base_timesheets.hours_balance_classifier_id', '=', 'hours_balance_classifiers.id')
            ->join('departments', 'base_timesheets.department_id', '=', 'departments.id')
            ->join('accounts', 'base_timesheets.account_id', '=', 'accounts.id')
            ->join('positions', 'base_timesheets.position_id', '=', 'positions.id')
            ->join('objects', 'base_timesheets.object_id', '=', 'objects.id')
            ->select('personal_cards.personal_account AS personal_card', 'years.number AS year', 'months.number AS month', 'accruals.title AS accrual', 'hours_balance_classifiers.title AS hours_balance_classifier', 'departments.abbr AS department', 'accounts.title AS account', 'positions.subordination_id AS position', 'objects.abbr AS object', 'base_timesheets.day_1', 'base_timesheets.day_2', 'base_timesheets.day_3', 'base_timesheets.day_4', 'base_timesheets.day_5', 'base_timesheets.day_6', 'base_timesheets.day_7', 'base_timesheets.day_8', 'base_timesheets.day_9', 'base_timesheets.day_10', 'base_timesheets.day_11', 'base_timesheets.day_12', 'base_timesheets.day_13', 'base_timesheets.day_14', 'base_timesheets.day_15', 'base_timesheets.day_16', 'base_timesheets.day_17', 'base_timesheets.day_18', 'base_timesheets.day_19', 'base_timesheets.day_20', 'base_timesheets.day_21', 'base_timesheets.day_22', 'base_timesheets.day_23', 'base_timesheets.day_24', 'base_timesheets.day_25', 'base_timesheets.day_26', 'base_timesheets.day_27', 'base_timesheets.day_28', 'base_timesheets.day_29', 'base_timesheets.day_30', 'base_timesheets.day_31', 'base_timesheets.amount', 'base_timesheets.actual_days', 'base_timesheets.vacation_days', 'base_timesheets.childbirth_leave', 'base_timesheets.sick_days', 'base_timesheets.other_days', 'base_timesheets.unpaid_leave', 'base_timesheets.absense from work', 'base_timesheets.weekend', 'base_timesheets.holidays', 'base_timesheets.hours', 'base_timesheets.night_hours', 'base_timesheets.overtime', 'base_timesheets.id')
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

        $columns = ['id', 'personal_card_id', 'year_id', 'month_id', 'accrual_id', 'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7', 'day_8', 'day_9', 'day_10', 'day_11', 'day_12', 'day_13', 'day_14', 'day_15', 'day_16', 'day_17', 'day_18', 'day_19', 'day_20', 'day_21', 'day_22', 'day_23', 'day_24', 'day_25', 'day_26', 'day_27', 'day_28', 'day_29', 'day_30', 'day_31', 'hours_balance_classifier_id', 'department_id', 'amount', 'actual_days', 'vacation_days', 'childbirth_leave', 'sick_days', 'other_days', 'unpaid_leave', 'absense from work', 'weekend', 'holidays', 'hours', 'night_hours', 'overtime', 'account_id', 'position_id', 'object_id', ];

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
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", description_abbr) AS accrual']);
                $result = Accruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'title AS hours_balance_classifier']);
                $result = HoursBalanceClassifiers::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'abbr AS department']);
                $result = Departments::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 6:
                $columns = implode(", ", ['id', 'title AS account']);
                $result = Accounts::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 7:
                $columns = implode(", ", ['id', 'title AS position']);
                $result = Positions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 8:
                $columns = implode(", ", ['id', 'title AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}