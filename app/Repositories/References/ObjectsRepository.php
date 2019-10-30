<?php

namespace App\Repositories\References;

use App\Models\References\ObjectGroups;
use App\Models\References\Objects as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class ObjectsRepository: Репозиторий списка объектов
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class ObjectsRepository extends CoreRepository {

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
            ->join('object_groups', 'objects.object_group_id', '=', 'object_groups.id')
            ->select('object_groups.title AS object_group', 'objects.abbr', 'objects.id')
            ->orderBy('object_groups.title')
            ->orderBy('objects.abbr')
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
            ->join('object_groups', 'objects.object_group_id', '=', 'object_groups.id')
            ->select('object_groups.title AS object_group', 'objects.title', 'objects.abbr', 'objects.id')
            ->where('objects.id', $id)
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

        $columns = ['id', 'object_group_id', 'title', 'abbr', ];

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
                $columns = implode(", ", ['id', 'title AS object_group']);
                $result = ObjectGroups::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}