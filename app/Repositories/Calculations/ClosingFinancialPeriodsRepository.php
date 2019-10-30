<?php

namespace App\Repositories\Calculations;

use App\Models\Calculations\ClosingFinancialPeriods as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class ClosingFinancialPeriodsRepository: Репозиторий обслуживания закрытия финансового периода
 *
 * @author SeBo
 *
 * @package App\Repositories\Calculations
 */
class ClosingFinancialPeriodsRepository extends CoreRepository {

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
            ->select('closing_financial_periods.id')
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
            ->select('closing_financial_periods.id')
            ->where('closing_financial_periods.id', $id)
            ->toBase()
            ->first();

        return $result;
    }

}