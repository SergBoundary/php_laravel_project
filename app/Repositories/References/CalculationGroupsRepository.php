<?php

namespace App\Repositories\References;

use App\Models\References\AccrualGroups;
use App\Models\References\Accruals;
use App\Models\References\CalculationGroups as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class CalculationGroupsRepository: Репозиторий списка видов расчетов
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class CalculationGroupsRepository extends CoreRepository {

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
            ->join('accrual_groups', 'calculation_groups.accrual_groups_id', '=', 'accrual_groups.id')
            ->join('accruals', 'calculation_groups.accrual_id', '=', 'accruals.id')
            ->select('accrual_groups.title AS accrual_groups', 'accruals.title AS accrual', 'calculation_groups.calculation_attribute', 'calculation_groups.id')
            ->orderBy('accrual_groups.title')
            ->orderBy('accruals.title')
            ->orderBy('calculation_groups.calculation_attribute')
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
            ->join('accrual_groups', 'calculation_groups.accrual_groups_id', '=', 'accrual_groups.id')
            ->join('accruals', 'calculation_groups.accrual_id', '=', 'accruals.id')
            ->select('accrual_groups.title AS accrual_groups', 'accruals.title AS accrual', 'calculation_groups.calculation_attribute', 'calculation_groups.id')
            ->where('calculation_groups.id', $id)
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

        $columns = ['id', 'accrual_groups_id', 'accrual_id', 'calculation_attribute', ];

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
                $columns = implode(", ", ['id', 'title AS accrual_groups']);
                $result = AccrualGroups::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", description_abbr) AS accrual']);
                $result = Accruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}