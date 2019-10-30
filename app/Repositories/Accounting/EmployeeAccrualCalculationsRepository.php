<?php

namespace App\Repositories\Accounting;

use App\Models\References\Objects;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Accruals;
use App\Models\References\Algorithms;
use App\Models\References\TaxRates;
use App\Models\Accounting\EmployeeAccrualCalculations as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class EmployeeAccrualCalculationsRepository: Репозиторий расчета сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class EmployeeAccrualCalculationsRepository extends CoreRepository {

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
            ->join('objects', 'employee_accrual_calculations.object_id', '=', 'objects.id')
            ->join('personal_cards', 'employee_accrual_calculations.personal_card_id', '=', 'personal_cards.id')
            ->join('accruals', 'employee_accrual_calculations.accrual_id', '=', 'accruals.id')
            ->join('algorithms', 'employee_accrual_calculations.algorithm_id', '=', 'algorithms.id')
            ->join('tax_rates', 'employee_accrual_calculations.tax_id', '=', 'tax_rates.id')
            ->select('objects.abbr AS object', 'personal_cards.personal_account AS personal_card', 'accruals.title AS accrual', 'algorithms.title AS algorithm', 'tax_rates.accrual_id AS tax', 'employee_accrual_calculations.accrual_amount', 'employee_accrual_calculations.id')
            ->orderBy('objects.abbr')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('accruals.title')
            ->orderBy('algorithms.title')
            ->orderBy('tax_rates.accrual_id')
            ->orderBy('employee_accrual_calculations.accrual_amount')
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
            ->join('objects', 'employee_accrual_calculations.object_id', '=', 'objects.id')
            ->join('personal_cards', 'employee_accrual_calculations.personal_card_id', '=', 'personal_cards.id')
            ->join('accruals', 'employee_accrual_calculations.accrual_id', '=', 'accruals.id')
            ->join('algorithms', 'employee_accrual_calculations.algorithm_id', '=', 'algorithms.id')
            ->join('tax_rates', 'employee_accrual_calculations.tax_id', '=', 'tax_rates.id')
            ->select('objects.abbr AS object', 'personal_cards.personal_account AS personal_card', 'accruals.title AS accrual', 'algorithms.title AS algorithm', 'tax_rates.accrual_id AS tax', 'employee_accrual_calculations.accrual_amount', 'employee_accrual_calculations.start', 'employee_accrual_calculations.expiry', 'employee_accrual_calculations.save_of_analytics', 'employee_accrual_calculations.account_title', 'employee_accrual_calculations.id')
            ->where('employee_accrual_calculations.id', $id)
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

        $columns = ['id', 'object_id', 'personal_card_id', 'accrual_id', 'algorithm_id', 'tax_id', 'accrual_amount', 'start', 'expiry', 'save_of_analytics', 'account_title', ];

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
                $columns = implode(", ", ['id', 'abbr AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(personal_account, ", ", surname, ", ", first_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
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
                $columns = implode(", ", ['id', 'title AS algorithm']);
                $result = Algorithms::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'CONCAT(accrual, ", ", title) AS tax']);
                $result = TaxRates::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}