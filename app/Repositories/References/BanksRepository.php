<?php

namespace App\Repositories\References;

use App\Models\References\Countries;
use App\Models\References\Banks as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class BanksRepository: Репозиторий списка банков
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class BanksRepository extends CoreRepository {

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
            ->join('countries', 'banks.country_id', '=', 'countries.id')
            ->select('countries.title AS country', 'banks.title', 'banks.commission', 'banks.id')
            ->orderBy('countries.title')
            ->orderBy('banks.title')
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
            ->join('countries', 'banks.country_id', '=', 'countries.id')
            ->select('countries.title AS country', 'banks.title', 'banks.commission', 'banks.id')
            ->where('banks.id', $id)
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

        $columns = ['id', 'country_id', 'title', 'commission', ];

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
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS country']);
                $result = Countries::selectRaw($columns)
                    ->where('visible', 1)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}