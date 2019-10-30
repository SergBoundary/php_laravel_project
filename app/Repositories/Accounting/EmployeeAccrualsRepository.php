<?php

namespace App\Repositories\Accounting;

use App\Models\References\Departments;
use App\Models\Accounting\DepartmentAccruals;
use App\Models\References\Teams;
use App\Models\References\Objects;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\CurrencyKurses;
use App\Models\Accounting\EmployeeAccruals as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class EmployeeAccrualsRepository: Репозиторий учета сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class EmployeeAccrualsRepository extends CoreRepository {

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
            ->join('departments', 'employee_accruals.department_id', '=', 'departments.id')
            ->join('department_accruals', 'employee_accruals.department_accrual_id', '=', 'department_accruals.id')
            ->join('teams', 'employee_accruals.team_id', '=', 'teams.id')
            ->join('objects', 'employee_accruals.object_id', '=', 'objects.id')
            ->join('personal_cards', 'employee_accruals.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'employee_accruals.year_id', '=', 'years.id')
            ->join('months', 'employee_accruals.month_id', '=', 'months.id')
            ->join('currency_kurses', 'employee_accruals.currency_kurs_id', '=', 'currency_kurses.id')
            ->select('departments.abbr AS department', 'department_accruals.department_id AS department_accrual', 'teams.abbr AS team', 'objects.abbr AS object', 'personal_cards.personal_account AS personal_card', 'years.number AS year', 'months.number AS month', 'currency_kurses.base currency_id AS currency_kurs', 'employee_accruals.accrual_amount', 'employee_accruals.id')
            ->orderBy('departments.abbr')
            ->orderBy('department_accruals.department_id')
            ->orderBy('teams.abbr')
            ->orderBy('objects.abbr')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('currency_kurses.base currency_id')
            ->orderBy('employee_accruals.accrual_amount')
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
            ->join('departments', 'employee_accruals.department_id', '=', 'departments.id')
            ->join('department_accruals', 'employee_accruals.department_accrual_id', '=', 'department_accruals.id')
            ->join('teams', 'employee_accruals.team_id', '=', 'teams.id')
            ->join('objects', 'employee_accruals.object_id', '=', 'objects.id')
            ->join('personal_cards', 'employee_accruals.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'employee_accruals.year_id', '=', 'years.id')
            ->join('months', 'employee_accruals.month_id', '=', 'months.id')
            ->join('currency_kurses', 'employee_accruals.currency_kurs_id', '=', 'currency_kurses.id')
            ->select('departments.abbr AS department', 'department_accruals.department_id AS department_accrual', 'teams.abbr AS team', 'objects.abbr AS object', 'personal_cards.personal_account AS personal_card', 'years.number AS year', 'months.number AS month', 'currency_kurses.base currency_id AS currency_kurs', 'employee_accruals.days', 'employee_accruals.hours', 'employee_accruals.accrual_amount', 'employee_accruals.account_title', 'employee_accruals.currency_id', 'employee_accruals.currency_amount', 'employee_accruals.tariff', 'employee_accruals.calculation_year', 'employee_accruals.calculation_month', 'employee_accruals.comment', 'employee_accruals.id')
            ->where('employee_accruals.id', $id)
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

        $columns = ['id', 'department_id', 'department_accrual_id', 'team_id', 'object_id', 'personal_card_id', 'year_id', 'month_id', 'days', 'hours', 'accrual_amount', 'account_title', 'currency_id', 'currency_amount', 'currency_kurs_id', 'tariff', 'calculation_year', 'calculation_month', 'comment', ];

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
                $columns = implode(", ", ['id', 'abbr AS department']);
                $result = Departments::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(department, ", ", team, ", ", object, ", ", year, ", ", month) AS department_accrual']);
                $result = DepartmentAccruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'abbr AS team']);
                $result = Teams::selectRaw($columns)
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
                $columns = implode(", ", ['id', 'CONCAT(personal_account, ", ", surname, ", ", first_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 6:
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 7:
                $columns = implode(", ", ['id', 'CONCAT(base currency, ", ", quoted currency, ", ", residual) AS currency_kurs']);
                $result = CurrencyKurses::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}