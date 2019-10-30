<?php

namespace App\Repositories\References;

use App\Models\References\GroupingTypesOfAbsences as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class GroupingTypesOfAbsencesRepository: Репозиторий списка видов отсутствия на работе
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class GroupingTypesOfAbsencesRepository extends CoreRepository {

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
            ->select('grouping_types_of_absences.title', 'grouping_types_of_absences.id')
            ->orderBy('grouping_types_of_absences.title')
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
            ->select('grouping_types_of_absences.title', 'grouping_types_of_absences.id')
            ->where('grouping_types_of_absences.id', $id)
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