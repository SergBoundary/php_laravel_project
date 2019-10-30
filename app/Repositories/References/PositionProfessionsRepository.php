<?php

namespace App\Repositories\References;

use App\Models\References\PositionProfessions as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PositionProfessionsRepository: Справочник. Государственный классификатор профессий
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class PositionProfessionsRepository extends CoreRepository {

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
            ->select('position_professions.code', 'position_professions.title', 'position_professions.id')
            ->orderBy('position_professions.code')
            ->orderBy('position_professions.title')
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
            ->select('position_professions.code', 'position_professions.title', 'position_professions.id')
            ->where('position_professions.id', $id)
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

        $columns = ['id', 'code', 'title', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}