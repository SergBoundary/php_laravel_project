<?php

namespace App\Repositories\References;

use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Models\References\Regions;
use App\Models\References\Cities;
use App\Models\References\TaxOffices as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class TaxOfficesRepository: Репозиторий списка налоговых инспекций
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class TaxOfficesRepository extends CoreRepository {

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
            ->join('countries', 'tax_offices.country_id', '=', 'countries.id')
            ->join('districts', 'tax_offices.district_id', '=', 'districts.id')
            ->join('regions', 'tax_offices.region_id', '=', 'regions.id')
            ->join('cities', 'tax_offices.city_id', '=', 'cities.id')
            ->select('countries.title AS country', 'districts.title AS district', 'regions.title AS region', 'cities.title AS city', 'tax_offices.title', 'tax_offices.id')
            ->orderBy('countries.title')
            ->orderBy('districts.title')
            ->orderBy('regions.title')
            ->orderBy('cities.title')
            ->orderBy('tax_offices.title')
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
            ->join('countries', 'tax_offices.country_id', '=', 'countries.id')
            ->join('districts', 'tax_offices.district_id', '=', 'districts.id')
            ->join('regions', 'tax_offices.region_id', '=', 'regions.id')
            ->join('cities', 'tax_offices.city_id', '=', 'cities.id')
            ->select('countries.title AS country', 'districts.title AS district', 'regions.title AS region', 'cities.title AS city', 'tax_offices.title', 'tax_offices.id')
            ->where('tax_offices.id', $id)
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

        $columns = ['id', 'country_id', 'district_id', 'region_id', 'city_id', 'title', ];

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
            case 3:
                $columns = implode(", ", ['id', 'title AS city']);
                $result = Cities::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}