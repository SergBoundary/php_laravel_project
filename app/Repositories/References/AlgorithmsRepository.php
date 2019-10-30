<?php

namespace App\Repositories\References;

use App\Models\References\Algorithms as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AlgorithmsRepository: Репозиторий списка алгоритмов начислений
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class AlgorithmsRepository extends CoreRepository {

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
            ->select('algorithms.title', 'algorithms.id')
            ->orderBy('algorithms.title')
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
            ->select('algorithms.title', 'algorithms.id')
            ->where('algorithms.id', $id)
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