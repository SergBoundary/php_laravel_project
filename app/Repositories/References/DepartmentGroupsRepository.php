<?php

namespace App\Repositories\References;

use App\Models\References\DepartmentGroups as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class DepartmentGroupsRepository: Репозиторий списка групп подразделений компании
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class DepartmentGroupsRepository extends CoreRepository {

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
            ->select('department_groups.title', 'department_groups.id')
            ->orderBy('department_groups.title')
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
            ->select('department_groups.title', 'department_groups.id')
            ->where('department_groups.id', $id)
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

        $columns = ['id', 'title', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}