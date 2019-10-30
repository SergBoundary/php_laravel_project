<?php

namespace App\Repositories\References;

use App\Models\References\Accruals;
use App\Models\References\GroupingTypesOfAbsences;
use App\Models\References\AbsenceClassifiers as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AbsenceClassifiersRepository: Справочник. Классификатор отсутствия на работе
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class AbsenceClassifiersRepository extends CoreRepository {

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
            ->join('accruals', 'absence_classifiers.accrual_id', '=', 'accruals.id')
            ->join('grouping_types_of_absences', 'absence_classifiers.absences_grouping_id', '=', 'grouping_types_of_absences.id')
            ->select('accruals.title AS accrual', 'grouping_types_of_absences.title AS absences_grouping', 'absence_classifiers.title', 'absence_classifiers.abbr', 'absence_classifiers.id')
            ->orderBy('accruals.title')
            ->orderBy('grouping_types_of_absences.title')
            ->orderBy('absence_classifiers.title')
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
            ->join('accruals', 'absence_classifiers.accrual_id', '=', 'accruals.id')
            ->join('grouping_types_of_absences', 'absence_classifiers.absences_grouping_id', '=', 'grouping_types_of_absences.id')
            ->select('accruals.title AS accrual', 'grouping_types_of_absences.title AS absences_grouping', 'absence_classifiers.title', 'absence_classifiers.abbr', 'absence_classifiers.id')
            ->where('absence_classifiers.id', $id)
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

        $columns = ['id', 'accrual_id', 'absences_grouping_id', 'title', 'abbr', ];

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
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", description_abbr) AS accrual']);
                $result = Accruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'title AS absences_grouping']);
                $result = GroupingTypesOfAbsences::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}