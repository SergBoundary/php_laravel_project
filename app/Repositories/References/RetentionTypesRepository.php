<?php

namespace App\Repositories\References;

use App\Models\References\RetentionTypes as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class RetentionTypesRepository: Репозиторий списка видов удержаний
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class RetentionTypesRepository extends CoreRepository {

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
            ->select('title', 'description', 'abbr', 'id')
            ->orderBy('id')
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
            ->select('retention_types.title', 'retention_types.description', 'retention_types.abbr', 'retention_types.id')
            ->where('retention_types.id', $id)
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

        $columns = ['id', 'title', 'description', 'abbr', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}