<?php

namespace App\Repositories\Calculations;

use App\Models\Calculations\PayrollPreparations as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PayrollPreparationsRepository: Репозиторий обслуживания подготовки расчета заработной платы
 *
 * @author SeBo
 *
 * @package App\Repositories\Calculations
 */
class PayrollPreparationsRepository extends CoreRepository {

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
            ->select('payroll_preparations.id')
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
            ->select('payroll_preparations.id')
            ->where('payroll_preparations.id', $id)
            ->toBase()
            ->first();

        return $result;
    }

}