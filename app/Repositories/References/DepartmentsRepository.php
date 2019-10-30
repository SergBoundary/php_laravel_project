<?php

namespace App\Repositories\References;

use App\Models\References\DepartmentGroups;
use App\Models\References\Departments as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class DepartmentsRepository: Репозиторий списка подразделений компании
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class DepartmentsRepository extends CoreRepository {

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
            ->join('department_groups', 'departments.department_group_id', '=', 'department_groups.id')
            ->select('department_groups.title AS department_group', 'departments.title', 'departments.abbr', 'departments.id')
            ->orderBy('department_groups.title')
            ->orderBy('departments.title')
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
            ->join('department_groups', 'departments.department_group_id', '=', 'department_groups.id')
            ->select('department_groups.title AS department_group', 'departments.title', 'departments.abbr', 'departments.department_attribute', 'departments.print_order', 'departments.id')
            ->where('departments.id', $id)
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

        $columns = ['id', 'department_group_id', 'title', 'abbr', 'department_attribute', 'print_order', ];

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
                $columns = implode(", ", ['id', 'title AS department_group']);
                $result = DepartmentGroups::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}