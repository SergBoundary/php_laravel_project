<?php

namespace App\Repositories\Accounting;

use App\Models\References\Accruals;
use App\Models\References\Accounts;
use App\Models\Accounting\BaseTimesheets;
use App\Models\References\Objects;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\AccrualTimesheets as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AccrualTimesheetsRepository: Репозиторий расчета сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class AccrualTimesheetsRepository extends CoreRepository {

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
            ->join('accruals', 'accrual_timesheets.accrual_id', '=', 'accruals.id')
            ->join('accounts', 'accrual_timesheets.account_id', '=', 'accounts.id')
            ->join('base_timesheets', 'accrual_timesheets.base_timesheet_id', '=', 'base_timesheets.id')
            ->join('objects', 'accrual_timesheets.object_id', '=', 'objects.id')
            ->join('years', 'accrual_timesheets.year_id', '=', 'years.id')
            ->join('months', 'accrual_timesheets.month_id', '=', 'months.id')
            ->select('accruals.title AS accrual', 'accounts.title AS account', 'base_timesheets.personal_card_id AS base_timesheet', 'objects.abbr AS object', 'years.number AS year', 'months.number AS month', 'accrual_timesheets.days', 'accrual_timesheets.hours', 'accrual_timesheets.id')
            ->orderBy('accruals.title')
            ->orderBy('accounts.title')
            ->orderBy('base_timesheets.personal_card_id')
            ->orderBy('objects.abbr')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('accrual_timesheets.days')
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
            ->join('accruals', 'accrual_timesheets.accrual_id', '=', 'accruals.id')
            ->join('accounts', 'accrual_timesheets.account_id', '=', 'accounts.id')
            ->join('base_timesheets', 'accrual_timesheets.base_timesheet_id', '=', 'base_timesheets.id')
            ->join('objects', 'accrual_timesheets.object_id', '=', 'objects.id')
            ->join('years', 'accrual_timesheets.year_id', '=', 'years.id')
            ->join('months', 'accrual_timesheets.month_id', '=', 'months.id')
            ->select('accruals.title AS accrual', 'accounts.title AS account', 'base_timesheets.personal_card_id AS base_timesheet', 'objects.abbr AS object', 'years.number AS year', 'months.number AS month', 'accrual_timesheets.days', 'accrual_timesheets.hours', 'accrual_timesheets.id')
            ->where('accrual_timesheets.id', $id)
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

        $columns = ['id', 'accrual_id', 'account_id', 'base_timesheet_id', 'object_id', 'year_id', 'month_id', 'days', 'hours', ];

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
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", description_abbr) AS accrual']);
                $result = Accruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'title AS account']);
                $result = Accounts::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'CONCAT(personal_card, ", ", year, ", ", month) AS base_timesheet']);
                $result = BaseTimesheets::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'abbr AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}