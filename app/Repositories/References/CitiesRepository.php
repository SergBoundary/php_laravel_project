<?php

namespace App\Repositories\References;

use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Models\References\Regions;
use App\Models\References\Cities as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class CitiesRepository: Репозиторий списка населенных пунктов
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class CitiesRepository extends CoreRepository {

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
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            ->join('districts', 'cities.district_id', '=', 'districts.id')
            ->join('regions', 'cities.region_id', '=', 'regions.id')
            ->select('countries.title AS country', 'districts.title AS district', 'regions.title AS region', 'cities.title', 'cities.national_name', 'cities.id')
            ->orderBy('countries.title')
            ->orderBy('districts.title')
            ->orderBy('regions.title')
            ->orderBy('cities.title')
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
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            ->join('districts', 'cities.district_id', '=', 'districts.id')
            ->join('regions', 'cities.region_id', '=', 'regions.id')
            ->select('countries.title AS country', 'districts.title AS district', 'regions.title AS region', 'cities.title', 'cities.national_name', 'cities.id')
            ->where('cities.id', $id)
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

        $columns = ['id', 'country_id', 'district_id', 'region_id', 'title', 'national_name', ];

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
            case 2:
                $columns = implode(", ", ['id', 'title AS region']);
                $result = Regions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}