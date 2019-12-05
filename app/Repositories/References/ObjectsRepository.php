<?php

namespace App\Repositories\References;

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
            ->select('objects.code', 'objects.title', 'objects.abbr', 'objects.id')
            ->orderBy('objects.code')
            ->orderBy('objects.title')
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
            ->select('objects.code', 'objects.title', 'objects.abbr', 'objects.id')
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

        $columns = ['id', 'code', 'title', 'abbr', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}