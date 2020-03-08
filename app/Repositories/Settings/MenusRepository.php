<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Menus as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class MenuRepository: Репозиторий настроек пользовательского меню системы
 *
 * @author SeBo
 *
 * @package App\Repositories\Settings
 */
class MenusRepository extends CoreRepository {

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
            ->select('menus.parent_id', 'menus.name', 'menus.path', 'menus.id')
            ->orderBy('menus.parent_id')
            ->orderBy('menus.name')
            ->orderBy('menus.path')
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
            ->select('menus.parent_id', 'menus.sort', 'menus.name', 'menus.path', 'menus.access_0', 'menus.access_1', 'menus.access_2', 'menus.access_3', 'menus.id')
            ->where('menus.id', $id)
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

        $columns = ['id', 'parent_id', 'sort', 'name', 'path', 'access_0', 'access_1', 'access_2', 'access_3', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}