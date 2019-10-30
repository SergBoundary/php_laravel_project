<?php

namespace App\Repositories\Accounting;

use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Departments;
use App\Models\References\Positions;
use App\Models\References\Objects;
use App\Models\References\Teams;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Accruals;
use App\Models\References\EmploymentTypes;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Accounts;
use App\Models\References\TaxScales;
use App\Models\References\Currencies;
use App\Models\References\CurrencyKurses;
use App\Models\Accounting\EmployeeAccrualMonths as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class EmployeeAccrualMonthsRepository: Репозиторий учета сумм начислений работникам за месяц
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class EmployeeAccrualMonthsRepository extends CoreRepository {

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
            ->join('years', 'employee_accrual_months.calculation_year_id', '=', 'years.id')
            ->join('months', 'employee_accrual_months.calculation_month_id', '=', 'months.id')
            ->join('departments', 'employee_accrual_months.department_id', '=', 'departments.id')
            ->join('positions', 'employee_accrual_months.position_id', '=', 'positions.id')
            ->join('objects', 'employee_accrual_months.object_id', '=', 'objects.id')
            ->join('teams', 'employee_accrual_months.team_id', '=', 'teams.id')
            ->join('personal_cards', 'employee_accrual_months.personal_card_id', '=', 'personal_cards.id')
            ->join('accruals', 'employee_accrual_months.accrual_id', '=', 'accruals.id')
            ->join('employment_types', 'employee_accrual_months.employment_type_id', '=', 'employment_types.id')
            ->join('years', 'employee_accrual_months.year_id', '=', 'years.id')
            ->join('months', 'employee_accrual_months.month_id', '=', 'months.id')
            ->join('accounts', 'employee_accrual_months.account_id', '=', 'accounts.id')
            ->join('tax_scales', 'employee_accrual_months.tax_scale_id', '=', 'tax_scales.id')
            ->join('currencies', 'employee_accrual_months.currency_id', '=', 'currencies.id')
            ->join('currency_kurses', 'employee_accrual_months.currency_kurs_id', '=', 'currency_kurses.id')
            ->select('years.number AS calculation_year', 'months.number AS calculation_month', 'departments.abbr AS department', 'positions.subordination_id AS position', 'objects.abbr AS object', 'teams.abbr AS team', 'personal_cards.personal_account AS personal_card', 'accruals.title AS accrual', 'employment_types.title AS employment_type', 'years.number AS year', 'months.number AS month', 'accounts.title AS account', 'tax_scales.title AS tax_scale', 'currencies.symbol AS currency', 'currency_kurses.base currency_id AS currency_kurs', 'employee_accrual_months.id')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('departments.abbr')
            ->orderBy('positions.subordination_id')
            ->orderBy('objects.abbr')
            ->orderBy('teams.abbr')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('accruals.title')
            ->orderBy('employment_types.title')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('accounts.title')
            ->orderBy('tax_scales.title')
            ->orderBy('currencies.symbol')
            ->orderBy('currency_kurses.base currency_id')
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
            ->join('years', 'employee_accrual_months.calculation_year_id', '=', 'years.id')
            ->join('months', 'employee_accrual_months.calculation_month_id', '=', 'months.id')
            ->join('departments', 'employee_accrual_months.department_id', '=', 'departments.id')
            ->join('positions', 'employee_accrual_months.position_id', '=', 'positions.id')
            ->join('objects', 'employee_accrual_months.object_id', '=', 'objects.id')
            ->join('teams', 'employee_accrual_months.team_id', '=', 'teams.id')
            ->join('personal_cards', 'employee_accrual_months.personal_card_id', '=', 'personal_cards.id')
            ->join('accruals', 'employee_accrual_months.accrual_id', '=', 'accruals.id')
            ->join('employment_types', 'employee_accrual_months.employment_type_id', '=', 'employment_types.id')
            ->join('years', 'employee_accrual_months.year_id', '=', 'years.id')
            ->join('months', 'employee_accrual_months.month_id', '=', 'months.id')
            ->join('accounts', 'employee_accrual_months.account_id', '=', 'accounts.id')
            ->join('tax_scales', 'employee_accrual_months.tax_scale_id', '=', 'tax_scales.id')
            ->join('currencies', 'employee_accrual_months.currency_id', '=', 'currencies.id')
            ->join('currency_kurses', 'employee_accrual_months.currency_kurs_id', '=', 'currency_kurses.id')
            ->select('years.number AS calculation_year', 'months.number AS calculation_month', 'departments.abbr AS department', 'positions.subordination_id AS position', 'objects.abbr AS object', 'teams.abbr AS team', 'personal_cards.personal_account AS personal_card', 'accruals.title AS accrual', 'employment_types.title AS employment_type', 'years.number AS year', 'months.number AS month', 'accounts.title AS account', 'tax_scales.title AS tax_scale', 'currencies.symbol AS currency', 'currency_kurses.base currency_id AS currency_kurs', 'employee_accrual_months.accrual_amount', 'employee_accrual_months.retention_amount', 'employee_accrual_months.days', 'employee_accrual_months.hours', 'employee_accrual_months.analytics', 'employee_accrual_months.currency_amount', 'employee_accrual_months.tariff', 'employee_accrual_months.ssc_amount', 'employee_accrual_months.ssc_amount_disability', 'employee_accrual_months.ssc_amount_sickness', 'employee_accrual_months.ssc_amount_disability_sickness', 'employee_accrual_months.ssc_amount_civil_contract', 'employee_accrual_months.retention_date', 'employee_accrual_months.comment', 'employee_accrual_months.id')
            ->where('employee_accrual_months.id', $id)
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

        $columns = ['id', 'calculation_year_id', 'calculation_month_id', 'department_id', 'position_id', 'object_id', 'team_id', 'personal_card_id', 'accrual_id', 'employment_type_id', 'year_id', 'month_id', 'account_id', 'tax_scale_id', 'accrual_amount', 'retention_amount', 'days', 'hours', 'analytics', 'currency_id', 'currency_amount', 'currency_kurs_id', 'tariff', 'ssc_amount', 'ssc_amount_disability', 'ssc_amount_sickness', 'ssc_amount_disability_sickness', 'ssc_amount_civil_contract', 'retention_date', 'comment', ];

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
                $columns = implode(", ", ['id', 'number AS calculation_year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'number AS calculation_month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'abbr AS department']);
                $result = Departments::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'CONCAT(subordination, ", ", title) AS position']);
                $result = Positions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'abbr AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'abbr AS team']);
                $result = Teams::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 6:
                $columns = implode(", ", ['id', 'CONCAT(personal_account, ", ", surname, ", ", first_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 7:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", description_abbr) AS accrual']);
                $result = Accruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 8:
                $columns = implode(", ", ['id', 'title AS employment_type']);
                $result = EmploymentTypes::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 9:
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 10:
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 11:
                $columns = implode(", ", ['id', 'title AS account']);
                $result = Accounts::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 12:
                $columns = implode(", ", ['id', 'title AS tax_scale']);
                $result = TaxScales::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 13:
                $columns = implode(", ", ['id', 'symbol AS currency']);
                $result = Currencies::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 14:
                $columns = implode(", ", ['id', 'CONCAT(base currency, ", ", quoted currency, ", ", residual) AS currency_kurs']);
                $result = CurrencyKurses::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}