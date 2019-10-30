<?php

namespace App\Repositories\References;

use App\Models\References\FamilyRelationTypes as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class FamilyRelationTypesRepository: Репозиторий списка видов степени родства
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class FamilyRelationTypesRepository extends CoreRepository {

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
            ->select('family_relation_types.title', 'family_relation_types.id')
            ->orderBy('family_relation_types.title')
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
            ->select('family_relation_types.title', 'family_relation_types.id')
            ->where('family_relation_types.id', $id)
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