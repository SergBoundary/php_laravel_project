<?php

namespace App\Repositories\References;

use App\Models\References\TaxRates;
use App\Models\References\TaxRateAmounts as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class TaxRateAmountsRepository: Справочник. Классификатор сумм оплаты налогов
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class TaxRateAmountsRepository extends CoreRepository {

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
            ->join('tax_rates', 'tax_rate_amounts.tax_rate_id', '=', 'tax_rates.id')
            ->select('tax_rates.accrual_id AS tax_rate', 'tax_rate_amounts.date_from', 'tax_rate_amounts.amount_from', 'tax_rate_amounts.amount_to', 'tax_rate_amounts.amount', 'tax_rate_amounts.percent', 'tax_rate_amounts.id')
            ->orderBy('tax_rates.accrual_id')
            ->orderBy('tax_rate_amounts.date_from')
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
            ->join('tax_rates', 'tax_rate_amounts.tax_rate_id', '=', 'tax_rates.id')
            ->select('tax_rates.accrual_id AS tax_rate', 'tax_rate_amounts.date_from', 'tax_rate_amounts.amount_from', 'tax_rate_amounts.amount_to', 'tax_rate_amounts.amount', 'tax_rate_amounts.percent', 'tax_rate_amounts.id')
            ->where('tax_rate_amounts.id', $id)
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

        $columns = ['id', 'tax_rate_id', 'date_from', 'amount_from', 'amount_to', 'amount', 'percent', ];

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
                $columns = implode(", ", ['id', 'CONCAT(accrual, ", ", title) AS tax_rate']);
                $result = TaxRates::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}