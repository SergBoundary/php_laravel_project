<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\Accounting\Vacations;
use App\Models\References\Accruals;
use App\Models\References\Accounts;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\VacationAmounts as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class VacationAmountsRepository: Репозиторий расчета сумм отпускных
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class VacationAmountsRepository extends CoreRepository {

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
            ->join('personal_cards', 'vacation_amounts.personal_card_id', '=', 'personal_cards.id')
            ->join('vacations', 'vacation_amounts.vacation_id', '=', 'vacations.id')
            ->join('accruals', 'vacation_amounts.accrual_id', '=', 'accruals.id')
            ->join('accounts', 'vacation_amounts.account_id', '=', 'accounts.id')
            ->join('years', 'vacation_amounts.year_id', '=', 'years.id')
            ->join('months', 'vacation_amounts.month_id', '=', 'months.id')
            ->join('years', 'vacation_amounts.calculation_year_id', '=', 'years.id')
            ->join('months', 'vacation_amounts.calculation_month_id', '=', 'months.id')
            ->select('personal_cards.personal_account AS personal_card', 'vacations.document_id AS vacation', 'accruals.title AS accrual', 'accounts.title AS account', 'years.number AS year', 'months.number AS month', 'years.number AS calculation_year', 'months.number AS calculation_month', 'vacation_amounts.date_from', 'vacation_amounts.date_to', 'vacation_amounts.amount_total', 'vacation_amounts.percent', 'vacation_amounts.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('vacations.document_id')
            ->orderBy('accruals.title')
            ->orderBy('accounts.title')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('vacation_amounts.date_from')
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
            ->join('personal_cards', 'vacation_amounts.personal_card_id', '=', 'personal_cards.id')
            ->join('vacations', 'vacation_amounts.vacation_id', '=', 'vacations.id')
            ->join('accruals', 'vacation_amounts.accrual_id', '=', 'accruals.id')
            ->join('accounts', 'vacation_amounts.account_id', '=', 'accounts.id')
            ->join('years', 'vacation_amounts.year_id', '=', 'years.id')
            ->join('months', 'vacation_amounts.month_id', '=', 'months.id')
            ->join('years', 'vacation_amounts.calculation_year_id', '=', 'years.id')
            ->join('months', 'vacation_amounts.calculation_month_id', '=', 'months.id')
            ->select('personal_cards.personal_account AS personal_card', 'vacations.document_id AS vacation', 'accruals.title AS accrual', 'accounts.title AS account', 'years.number AS year', 'months.number AS month', 'years.number AS calculation_year', 'months.number AS calculation_month', 'vacation_amounts.date_from', 'vacation_amounts.date_to', 'vacation_amounts.calculation_type', 'vacation_amounts.days', 'vacation_amounts.hours', 'vacation_amounts.days_unpaid', 'vacation_amounts.days_paid', 'vacation_amounts.days_total', 'vacation_amounts.hours_total', 'vacation_amounts.amount_days', 'vacation_amounts.amount_hours', 'vacation_amounts.amount_total', 'vacation_amounts.percent', 'vacation_amounts.id')
            ->where('vacation_amounts.id', $id)
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

        $columns = ['id', 'personal_card_id', 'vacation_id', 'accrual_id', 'account_id', 'year_id', 'month_id', 'calculation_year_id', 'calculation_month_id', 'date_from', 'date_to', 'calculation_type', 'days', 'hours', 'days_unpaid', 'days_paid', 'days_total', 'hours_total', 'amount_days', 'amount_hours', 'amount_total', 'percent', ];

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
                $columns = implode(", ", ['id', 'CONCAT(document, ", ", start, ", ", expiry) AS vacation']);
                $result = Vacations::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", description_abbr) AS accrual']);
                $result = Accruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'title AS account']);
                $result = Accounts::selectRaw($columns)
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
            case 6:
                $columns = implode(", ", ['id', 'number AS calculation_year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 7:
                $columns = implode(", ", ['id', 'number AS calculation_month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}