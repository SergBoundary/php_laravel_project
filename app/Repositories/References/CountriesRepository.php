<?php

namespace App\Repositories\References;

use App\Models\References\Countries as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class CountriesRepository: Репозиторий списка стран
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class CountriesRepository extends CoreRepository {

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
            ->select('countries.title', 'countries.national_name', 'countries.symbol_alfa2', 'countries.symbol_alfa3', 'countries.number_iso', 'countries.id')
            ->orderBy('countries.title')
            ->orderBy('countries.national_name')
            ->orderBy('countries.symbol_alfa2')
            ->orderBy('countries.symbol_alfa3')
            ->orderBy('countries.number_iso')
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
            ->select('countries.title', 'countries.national_name', 'countries.symbol_alfa2', 'countries.symbol_alfa3', 'countries.number_iso', 'countries.visible', 'countries.id')
            ->where('countries.id', $id)
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

        $columns = ['id', 'title', 'national_name', 'symbol_alfa2', 'symbol_alfa3', 'number_iso', 'visible', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}