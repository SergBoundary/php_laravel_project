<?php

namespace App\Repositories\References;

use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Models\References\Regions as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class RegionsRepository: Репозиторий списка районов
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class RegionsRepository extends CoreRepository {

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
            ->join('countries', 'regions.country_id', '=', 'countries.id')
            ->join('districts', 'regions.district_id', '=', 'districts.id')
            ->select('countries.title AS country', 'districts.title AS district', 'regions.title', 'regions.national_name', 'regions.id')
            ->orderBy('countries.title')
            ->orderBy('districts.title')
            ->orderBy('regions.title')
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
            ->join('countries', 'regions.country_id', '=', 'countries.id')
            ->join('districts', 'regions.district_id', '=', 'districts.id')
            ->select('countries.title AS country', 'districts.title AS district', 'regions.title', 'regions.national_name', 'regions.id')
            ->where('regions.id', $id)
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

        $columns = ['id', 'country_id', 'district_id', 'title', 'national_name', ];

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
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", number_iso) AS district']);
                $result = Districts::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}