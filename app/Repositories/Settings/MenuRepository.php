<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Menu as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class MenusRepository: Репозиторий настроек пользовательского меню системы
 *
 * @author SeBo
 *
 * @package App\Repositories\Settings
 */
class MenuRepository extends CoreRepository {

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
    public function getTable($orderBy, $perPage = null) {

        $result = $this->startConditions()
            ->select('menus.parent_id', 'menus.name', 'menus.path')
            ->orderBy('menus.parent_id')
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
            ->select('menus.parent_id', 'menus.sort', 'menus.name', 'menus.path', 'menus.access_0', 'menus.access_1', 'menus.access_2', 'menus.access_3')
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