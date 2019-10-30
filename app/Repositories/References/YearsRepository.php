<?php

namespace App\Repositories\References;

use App\Models\References\Years as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class YearsRepository: Репозиторий списка годов
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class YearsRepository extends CoreRepository {

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
            ->select('years.number', 'years.id')
            ->orderBy('years.number')
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
            ->select('years.number', 'years.id')
            ->where('years.id', $id)
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

        $columns = ['id', 'number', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}