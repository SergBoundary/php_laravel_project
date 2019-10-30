<?php

namespace App\Repositories\References;

use App\Models\References\Accruals;
use App\Models\References\TaxRates as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class TaxRatesRepository: Справочник. Классификатор налоговых ставок
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class TaxRatesRepository extends CoreRepository {

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
            ->join('accruals', 'tax_rates.accrual_id', '=', 'accruals.id')
            ->select('accruals.title AS accrual', 'tax_rates.title', 'tax_rates.id')
            ->orderBy('accruals.title')
            ->orderBy('tax_rates.title')
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
            ->join('accruals', 'tax_rates.accrual_id', '=', 'accruals.id')
            ->select('accruals.title AS accrual', 'tax_rates.title', 'tax_rates.id')
            ->where('tax_rates.id', $id)
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

        $columns = ['id', 'accrual_id', 'title', ];

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
        }

        return $result;
    }

}