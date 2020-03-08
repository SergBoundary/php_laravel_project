<?php

namespace App\Repositories\References;

use App\Models\References\AccrualTypes as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AccrualTypesRepository: Репозиторий списка видов начислений
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class AccrualTypesRepository extends CoreRepository {

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
            ->select('accrual_types.title', 'accrual_types.description', 'accrual_types.abbr', 'accrual_types.id')
            ->where('accrual_types.id', $id)
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