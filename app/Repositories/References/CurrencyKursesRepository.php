<?php

namespace App\Repositories\References;

use App\Models\References\Currencies;
use App\Models\References\Currencies;
use App\Models\References\CurrencyKurses as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class CurrencyKursesRepository: Репозиторий списка текущих курсов валют
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class CurrencyKursesRepository extends CoreRepository {

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
            ->join('currencies', 'currency_kurses.base currency_id', '=', 'currencies.id')
            ->join('currencies', 'currency_kurses.quoted currency_id', '=', 'currencies.id')
            ->select('currencies.symbol AS base currency', 'currencies.symbol AS quoted currency', 'currency_kurses.scale', 'currency_kurses.residual', 'currency_kurses.id')
            ->orderBy('currencies.symbol')
            ->orderBy('currencies.symbol')
            ->orderBy('currency_kurses.scale')
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
            ->join('currencies', 'currency_kurses.base currency_id', '=', 'currencies.id')
            ->join('currencies', 'currency_kurses.quoted currency_id', '=', 'currencies.id')
            ->select('currencies.symbol AS base currency', 'currencies.symbol AS quoted currency', 'currency_kurses.scale', 'currency_kurses.residual', 'currency_kurses.bay', 'currency_kurses.sell', 'currency_kurses.id')
            ->where('currency_kurses.id', $id)
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

        $columns = ['id', 'base currency_id', 'quoted currency_id', 'scale', 'residual', 'bay', 'sell', ];

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
                $columns = implode(", ", ['id', 'symbol AS base currency']);
                $result = Currencies::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'symbol AS quoted currency']);
                $result = Currencies::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}