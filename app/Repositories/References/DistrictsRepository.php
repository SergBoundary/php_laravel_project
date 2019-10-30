<?php

namespace App\Repositories\References;

use App\Models\References\Countries;
use App\Models\References\Districts as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class DistrictsRepository: Репозиторий списка областей (штатов, земель, воевудств)
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class DistrictsRepository extends CoreRepository {

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
            ->join('countries', 'districts.country_id', '=', 'countries.id')
            ->select('countries.title AS country', 'districts.title', 'districts.national_name', 'districts.number_iso', 'districts.id')
            ->orderBy('countries.title')
            ->orderBy('districts.title')
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
            ->join('countries', 'districts.country_id', '=', 'countries.id')
            ->select('countries.title AS country', 'districts.title', 'districts.national_name', 'districts.number_iso', 'districts.id')
            ->where('districts.id', $id)
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

        $columns = ['id', 'country_id', 'title', 'national_name', 'number_iso', ];

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