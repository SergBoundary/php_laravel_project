<?php

namespace App\Repositories\References;

use App\Models\References\Accruals;
use App\Models\References\AccrualRelations as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AccrualRelationsRepository: Репозиторий списка зависимостей начислений
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class AccrualRelationsRepository extends CoreRepository {

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
            ->join('accruals', 'accrual_relations.accrual_id', '=', 'accruals.id')
            ->select('accruals.title AS accrual', 'accrual_relations.relation_attribute', 'accrual_relations.id')
            ->orderBy('accruals.title')
            ->orderBy('accrual_relations.relation_attribute')
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
            ->join('accruals', 'accrual_relations.accrual_id', '=', 'accruals.id')
            ->select('accruals.title AS accrual', 'accrual_relations.relation_attribute', 'accrual_relations.id')
            ->where('accrual_relations.id', $id)
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

        $columns = ['id', 'accrual_id', 'relation_attribute', ];

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
        }

        return $result;
    }

}