<?php

namespace App\Repositories\References;

use App\Models\References\PieceworksUnits;
use App\Models\References\Accruals;
use App\Models\References\Pieceworks as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PieceworksRepository: Репозиторий списка сдельных работ
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class PieceworksRepository extends CoreRepository {

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
            ->join('pieceworks_units', 'pieceworks.pieceworks_unit_id', '=', 'pieceworks_units.id')
            ->join('accruals', 'pieceworks.accrual_id', '=', 'accruals.id')
            ->select('pieceworks_units.title AS pieceworks_unit', 'accruals.title AS accrual', 'pieceworks.pieceworks_unit_id', 'pieceworks.price', 'pieceworks.id')
            ->orderBy('pieceworks_units.title')
            ->orderBy('accruals.title')
            ->orderBy('pieceworks.pieceworks_unit_id')
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
            ->join('pieceworks_units', 'pieceworks.pieceworks_unit_id', '=', 'pieceworks_units.id')
            ->join('accruals', 'pieceworks.accrual_id', '=', 'accruals.id')
            ->select('pieceworks_units.title AS pieceworks_unit', 'accruals.title AS accrual', 'pieceworks.pieceworks_unit_id', 'pieceworks.price', 'pieceworks.id')
            ->where('pieceworks.id', $id)
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

        $columns = ['id', 'title', 'pieceworks_unit_id', 'price', 'accrual_id', ];

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
                $columns = implode(", ", ['id', 'title AS pieceworks_unit']);
                $result = PieceworksUnits::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", description_abbr) AS accrual']);
                $result = Accruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}