<?php

namespace App\Repositories\References;

use App\Models\References\TaxScales as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class TaxScalesRepository: Справочник. Шкала расчета подоходного налога
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class TaxScalesRepository extends CoreRepository {

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
            ->select('tax_scales.title', 'tax_scales.lower amount', 'tax_scales.top amount', 'tax_scales.tax percentage', 'tax_scales.id')
            ->orderBy('tax_scales.title')
            ->orderBy('tax_scales.lower amount')
            ->orderBy('tax_scales.top amount')
            ->orderBy('tax_scales.tax percentage')
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
            ->select('tax_scales.title', 'tax_scales.lower amount', 'tax_scales.top amount', 'tax_scales.tax percentage', 'tax_scales.id')
            ->where('tax_scales.id', $id)
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

        $columns = ['id', 'title', 'lower amount', 'top amount', 'tax percentage', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}