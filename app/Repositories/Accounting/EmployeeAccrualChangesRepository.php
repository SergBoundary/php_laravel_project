<?php

namespace App\Repositories\Accounting;

use App\Models\References\Algorithms;
use App\Models\References\TaxRates;
use App\Models\Accounting\EmployeeAccrualChanges as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class EmployeeAccrualChangesRepository: Репозиторий учета переформирования начислений работникам
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class EmployeeAccrualChangesRepository extends CoreRepository {

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
            ->join('algorithms', 'employee_accrual_changes.algorithm_id', '=', 'algorithms.id')
            ->join('tax_rates', 'employee_accrual_changes.tax_rates_id', '=', 'tax_rates.id')
            ->select('algorithms.title AS algorithm', 'tax_rates.accrual_id AS tax_rates', 'employee_accrual_changes.date_to', 'employee_accrual_changes.amount', 'employee_accrual_changes.id')
            ->orderBy('algorithms.title')
            ->orderBy('tax_rates.accrual_id')
            ->orderBy('employee_accrual_changes.date_to')
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
            ->join('algorithms', 'employee_accrual_changes.algorithm_id', '=', 'algorithms.id')
            ->join('tax_rates', 'employee_accrual_changes.tax_rates_id', '=', 'tax_rates.id')
            ->select('algorithms.title AS algorithm', 'tax_rates.accrual_id AS tax_rates', 'employee_accrual_changes.date_to', 'employee_accrual_changes.amount', 'employee_accrual_changes.id')
            ->where('employee_accrual_changes.id', $id)
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

        $columns = ['id', 'algorithm_id', 'tax_rates_id', 'date_to', 'amount', ];

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
                $columns = implode(", ", ['id', 'title AS algorithm']);
                $result = Algorithms::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(accrual, ", ", title) AS tax_rates']);
                $result = TaxRates::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}