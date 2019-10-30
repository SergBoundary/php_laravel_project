<?php

namespace App\Repositories\References;

use App\Models\References\AccrualGroups as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AccrualGroupsRepository: Репозиторий списка групп видов начислений
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class AccrualGroupsRepository extends CoreRepository {

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
            ->select('accrual_groups.title', 'accrual_groups.description', 'accrual_groups.type', 'accrual_groups.id')
            ->orderBy('accrual_groups.title')
            ->orderBy('accrual_groups.description')
            ->orderBy('accrual_groups.type')
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
            ->select('accrual_groups.title', 'accrual_groups.description', 'accrual_groups.type', 'accrual_groups.id')
            ->where('accrual_groups.id', $id)
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

        $columns = ['id', 'title', 'description', 'type', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}