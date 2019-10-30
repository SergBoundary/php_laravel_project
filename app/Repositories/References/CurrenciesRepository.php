<?php

namespace App\Repositories\References;

use App\Models\References\Currencies as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class CurrenciesRepository: Репозиторий списка валют
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class CurrenciesRepository extends CoreRepository {

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
            ->select('currencies.title', 'currencies.symbol', 'currencies.id')
            ->orderBy('currencies.title')
            ->orderBy('currencies.symbol')
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
            ->select('currencies.title', 'currencies.symbol', 'currencies.id')
            ->where('currencies.id', $id)
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

        $columns = ['id', 'title', 'symbol', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}