<?php

namespace App\Repositories\Calculations;

use App\Models\Calculations\Paychecks as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PaychecksRepository: Репозиторий обслуживания расчетного листа по заработной плате
 *
 * @author SeBo
 *
 * @package App\Repositories\Calculations
 */
class PaychecksRepository extends CoreRepository {

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
            ->select('paychecks.id')
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
            ->select('paychecks.id')
            ->where('paychecks.id', $id)
            ->toBase()
            ->first();

        return $result;
    }

}