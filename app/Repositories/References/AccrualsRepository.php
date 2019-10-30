<?php

namespace App\Repositories\References;

use App\Models\References\AccrualGroups;
use App\Models\References\Algorithms;
use App\Models\References\Accruals as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AccrualsRepository: Справочник. Классификатор начислений
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class AccrualsRepository extends CoreRepository {

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
            ->join('accrual_groups', 'accruals.accrual_group_id', '=', 'accrual_groups.id')
            ->join('algorithms', 'accruals.algorithm_id', '=', 'algorithms.id')
            ->select('accrual_groups.title AS accrual_group', 'algorithms.title AS algorithm', 'accruals.title', 'accruals.direction', 'accruals.description_abbr', 'accruals.id')
            ->orderBy('accrual_groups.title')
            ->orderBy('algorithms.title')
            ->orderBy('accruals.title')
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
            ->join('accrual_groups', 'accruals.accrual_group_id', '=', 'accrual_groups.id')
            ->join('algorithms', 'accruals.algorithm_id', '=', 'algorithms.id')
            ->select('accrual_groups.title AS accrual_group', 'algorithms.title AS algorithm', 'accruals.title', 'accruals.direction', 'accruals.description', 'accruals.description_abbr', 'accruals.description_1c', 'accruals.accrual_sum', 'accruals.income_number_8dr', 'accruals.calculation_number', 'accruals.accrual_amount', 'accruals.accrual_analytics', 'accruals.rounded amount', 'accruals.rounded result', 'accruals.account_title', 'accruals.id')
            ->where('accruals.id', $id)
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

        $columns = ['id', 'accrual_group_id', 'title', 'direction', 'description', 'description_abbr', 'description_1c', 'algorithm_id', 'accrual_sum', 'income_number_8dr', 'calculation_number', 'accrual_amount', 'accrual_analytics', 'rounded amount', 'rounded result', 'account_title', ];

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
                $columns = implode(", ", ['id', 'title AS accrual_group']);
                $result = AccrualGroups::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'title AS algorithm']);
                $result = Algorithms::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}