<?php

namespace App\Repositories\References;

use App\Models\References\Subordinations;
use App\Models\References\PositionProfessions;
use App\Models\References\PositionCategories;
use App\Models\References\Positions as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PositionsRepository: Репозиторий списка должностей
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class PositionsRepository extends CoreRepository {

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
            ->join('subordinations', 'positions.subordination_id', '=', 'subordinations.id')
            ->join('position_professions', 'positions.position_profession_id', '=', 'position_professions.id')
            ->join('position_categories', 'positions.position_category_id', '=', 'position_categories.id')
            ->select('subordinations.title AS subordination', 'position_professions.code AS position_profession', 'position_categories.title AS position_category', 'positions.title', 'positions.id')
            ->orderBy('subordinations.title')
            ->orderBy('position_professions.code')
            ->orderBy('position_categories.title')
            ->orderBy('positions.title')
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
            ->join('subordinations', 'positions.subordination_id', '=', 'subordinations.id')
            ->join('position_professions', 'positions.position_profession_id', '=', 'position_professions.id')
            ->join('position_categories', 'positions.position_category_id', '=', 'position_categories.id')
            ->select('subordinations.title AS subordination', 'position_professions.code AS position_profession', 'position_categories.title AS position_category', 'positions.title', 'positions.id')
            ->where('positions.id', $id)
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

        $columns = ['id', 'subordination_id', 'position_profession_id', 'position_category_id', 'title', ];

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
                $columns = implode(", ", ['id', 'title AS subordination']);
                $result = Subordinations::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(code, ", ", title) AS position_profession']);
                $result = PositionProfessions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS position_category']);
                $result = PositionCategories::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}