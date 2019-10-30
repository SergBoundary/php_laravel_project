<?php

namespace App\Repositories\References;

use App\Models\References\DismissalReasons as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class DismissalReasonsRepository: Репозиторий списка оснований увольнения работника
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class DismissalReasonsRepository extends CoreRepository {

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
            ->select('dismissal_reasons.title', 'dismissal_reasons.id')
            ->orderBy('dismissal_reasons.title')
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
            ->select('dismissal_reasons.title', 'dismissal_reasons.id')
            ->where('dismissal_reasons.id', $id)
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