<?php

namespace App\Repositories\Accounting;

use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\HoursBalanceClassifiers;
use App\Models\Accounting\HoursBalances as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class HoursBalancesRepository: Репозиторий учета распределения часов
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class HoursBalancesRepository extends CoreRepository {

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
            ->join('years', 'hours_balances.year_id', '=', 'years.id')
            ->join('months', 'hours_balances.month_id', '=', 'months.id')
            ->join('hours_balance_classifiers', 'hours_balances.hours_balance_classifier_id', '=', 'hours_balance_classifiers.id')
            ->select('years.number AS year', 'months.number AS month', 'hours_balance_classifiers.title AS hours_balance_classifier', 'hours_balances.balance_days', 'hours_balances.balance_hours', 'hours_balances.weekends', 'hours_balances.holidays', 'hours_balances.balance_evening', 'hours_balances.balance_night', 'hours_balances.id')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('hours_balance_classifiers.title')
            ->orderBy('hours_balances.balance_days')
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
            ->join('years', 'hours_balances.year_id', '=', 'years.id')
            ->join('months', 'hours_balances.month_id', '=', 'months.id')
            ->join('hours_balance_classifiers', 'hours_balances.hours_balance_classifier_id', '=', 'hours_balance_classifiers.id')
            ->select('years.number AS year', 'months.number AS month', 'hours_balance_classifiers.title AS hours_balance_classifier', 'hours_balances.balance_days', 'hours_balances.balance_hours', 'hours_balances.day_1', 'hours_balances.day_2', 'hours_balances.day_3', 'hours_balances.day_4', 'hours_balances.day_5', 'hours_balances.day_6', 'hours_balances.day_7', 'hours_balances.day_8', 'hours_balances.day_9', 'hours_balances.day_10', 'hours_balances.day_11', 'hours_balances.day_12', 'hours_balances.day_13', 'hours_balances.day_14', 'hours_balances.day_15', 'hours_balances.day_16', 'hours_balances.day_17', 'hours_balances.day_18', 'hours_balances.day_19', 'hours_balances.day_20', 'hours_balances.day_21', 'hours_balances.day_22', 'hours_balances.day_23', 'hours_balances.day_24', 'hours_balances.day_25', 'hours_balances.day_26', 'hours_balances.day_27', 'hours_balances.day_28', 'hours_balances.day_29', 'hours_balances.day_30', 'hours_balances.day_31', 'hours_balances.evening_1', 'hours_balances.evening_2', 'hours_balances.evening_3', 'hours_balances.evening_4', 'hours_balances.evening_5', 'hours_balances.evening_6', 'hours_balances.evening_7', 'hours_balances.evening_8', 'hours_balances.evening_9', 'hours_balances.evening_10', 'hours_balances.evening_11', 'hours_balances.evening_12', 'hours_balances.evening_13', 'hours_balances.evening_14', 'hours_balances.evening_15', 'hours_balances.evening_16', 'hours_balances.evening_17', 'hours_balances.evening_18', 'hours_balances.evening_19', 'hours_balances.evening_20', 'hours_balances.evening_21', 'hours_balances.evening_22', 'hours_balances.evening_23', 'hours_balances.evening_24', 'hours_balances.evening_25', 'hours_balances.evening_26', 'hours_balances.evening_27', 'hours_balances.evening_28', 'hours_balances.evening_29', 'hours_balances.evening_30', 'hours_balances.evening_31', 'hours_balances.night_1', 'hours_balances.night_2', 'hours_balances.night_3', 'hours_balances.night_4', 'hours_balances.night_5', 'hours_balances.night_6', 'hours_balances.night_7', 'hours_balances.night_8', 'hours_balances.night_9', 'hours_balances.night_10', 'hours_balances.night_11', 'hours_balances.night_12', 'hours_balances.night_13', 'hours_balances.night_14', 'hours_balances.night_15', 'hours_balances.night_16', 'hours_balances.night_17', 'hours_balances.night_18', 'hours_balances.night_19', 'hours_balances.night_20', 'hours_balances.night_21', 'hours_balances.night_22', 'hours_balances.night_23', 'hours_balances.night_24', 'hours_balances.night_25', 'hours_balances.night_26', 'hours_balances.night_27', 'hours_balances.night_28', 'hours_balances.night_29', 'hours_balances.night_30', 'hours_balances.night_31', 'hours_balances.holiday_1', 'hours_balances.holiday_2', 'hours_balances.holiday_3', 'hours_balances.holiday_4', 'hours_balances.holiday_5', 'hours_balances.holiday_6', 'hours_balances.holiday_7', 'hours_balances.holiday_8', 'hours_balances.holiday_9', 'hours_balances.holiday_10', 'hours_balances.holiday_11', 'hours_balances.holiday_12', 'hours_balances.holiday_13', 'hours_balances.holiday_14', 'hours_balances.holiday_15', 'hours_balances.holiday_16', 'hours_balances.holiday_17', 'hours_balances.holiday_18', 'hours_balances.holiday_19', 'hours_balances.holiday_20', 'hours_balances.holiday_21', 'hours_balances.holiday_22', 'hours_balances.holiday_23', 'hours_balances.holiday_24', 'hours_balances.holiday_25', 'hours_balances.holiday_26', 'hours_balances.holiday_27', 'hours_balances.holiday_28', 'hours_balances.holiday_29', 'hours_balances.holiday_30', 'hours_balances.holiday_31', 'hours_balances.weekends', 'hours_balances.holidays', 'hours_balances.balance_evening', 'hours_balances.balance_night', 'hours_balances.id')
            ->where('hours_balances.id', $id)
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

        $columns = ['id', 'year_id', 'month_id', 'hours_balance_classifier_id', 'balance_days', 'balance_hours', 'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7', 'day_8', 'day_9', 'day_10', 'day_11', 'day_12', 'day_13', 'day_14', 'day_15', 'day_16', 'day_17', 'day_18', 'day_19', 'day_20', 'day_21', 'day_22', 'day_23', 'day_24', 'day_25', 'day_26', 'day_27', 'day_28', 'day_29', 'day_30', 'day_31', 'evening_1', 'evening_2', 'evening_3', 'evening_4', 'evening_5', 'evening_6', 'evening_7', 'evening_8', 'evening_9', 'evening_10', 'evening_11', 'evening_12', 'evening_13', 'evening_14', 'evening_15', 'evening_16', 'evening_17', 'evening_18', 'evening_19', 'evening_20', 'evening_21', 'evening_22', 'evening_23', 'evening_24', 'evening_25', 'evening_26', 'evening_27', 'evening_28', 'evening_29', 'evening_30', 'evening_31', 'night_1', 'night_2', 'night_3', 'night_4', 'night_5', 'night_6', 'night_7', 'night_8', 'night_9', 'night_10', 'night_11', 'night_12', 'night_13', 'night_14', 'night_15', 'night_16', 'night_17', 'night_18', 'night_19', 'night_20', 'night_21', 'night_22', 'night_23', 'night_24', 'night_25', 'night_26', 'night_27', 'night_28', 'night_29', 'night_30', 'night_31', 'holiday_1', 'holiday_2', 'holiday_3', 'holiday_4', 'holiday_5', 'holiday_6', 'holiday_7', 'holiday_8', 'holiday_9', 'holiday_10', 'holiday_11', 'holiday_12', 'holiday_13', 'holiday_14', 'holiday_15', 'holiday_16', 'holiday_17', 'holiday_18', 'holiday_19', 'holiday_20', 'holiday_21', 'holiday_22', 'holiday_23', 'holiday_24', 'holiday_25', 'holiday_26', 'holiday_27', 'holiday_28', 'holiday_29', 'holiday_30', 'holiday_31', 'weekends', 'holidays', 'balance_evening', 'balance_night', ];

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
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS hours_balance_classifier']);
                $result = HoursBalanceClassifiers::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}