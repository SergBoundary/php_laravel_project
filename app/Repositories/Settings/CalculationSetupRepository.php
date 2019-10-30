<?php

namespace App\Repositories\Settings;

use App\Models\Settings\CalculationSetup as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class CalculationSetupRepository: Репозиторий настроек финансовых параметров расчетов
 *
 * @author SeBo
 *
 * @package App\Repositories\Settings
 */
class CalculationSetupRepository extends CoreRepository {

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
            ->select('calculation_setup.title', 'calculation_setup.value', 'calculation_setup.start', 'calculation_setup.expiry', 'calculation_setup.id')
            ->orderBy('calculation_setup.title')
            ->orderBy('calculation_setup.value')
            ->orderBy('calculation_setup.start')
            ->orderBy('calculation_setup.expiry')
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
            ->select('calculation_setup.title', 'calculation_setup.description', 'calculation_setup.condition', 'calculation_setup.value', 'calculation_setup.start', 'calculation_setup.expiry')
            ->where('calculation_setup.id', $id)
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

        $columns = ['id', 'title', 'description', 'condition', 'value', 'start', 'expiry', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}