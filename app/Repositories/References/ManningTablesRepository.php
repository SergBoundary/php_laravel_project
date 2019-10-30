<?php

namespace App\Repositories\References;

use App\Models\References\Departments;
use App\Models\References\Positions;
use App\Models\References\Ranks;
use App\Models\References\ManningTables as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class ManningTablesRepository: Справочник. Штатное расписание - список количеств, окладов и квалификации работников
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class ManningTablesRepository extends CoreRepository {

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
            ->join('departments', 'manning_tables.department_id', '=', 'departments.id')
            ->join('positions', 'manning_tables.position_id', '=', 'positions.id')
            ->join('ranks', 'manning_tables.rank_id', '=', 'ranks.id')
            ->select('departments.abbr AS department', 'positions.subordination_id AS position', 'ranks.title AS rank', 'manning_tables.quantity', 'manning_tables.salary', 'manning_tables.tariff', 'manning_tables.id')
            ->orderBy('departments.abbr')
            ->orderBy('positions.subordination_id')
            ->orderBy('ranks.title')
            ->orderBy('manning_tables.quantity')
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
            ->join('departments', 'manning_tables.department_id', '=', 'departments.id')
            ->join('positions', 'manning_tables.position_id', '=', 'positions.id')
            ->join('ranks', 'manning_tables.rank_id', '=', 'ranks.id')
            ->select('departments.abbr AS department', 'positions.subordination_id AS position', 'ranks.title AS rank', 'manning_tables.quantity', 'manning_tables.salary', 'manning_tables.tariff', 'manning_tables.id')
            ->where('manning_tables.id', $id)
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

        $columns = ['id', 'department_id', 'position_id', 'rank_id', 'quantity', 'salary', 'tariff', ];

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
                $columns = implode(", ", ['id', 'abbr AS department']);
                $result = Departments::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(subordination, ", ", title) AS position']);
                $result = Positions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS rank']);
                $result = Ranks::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}