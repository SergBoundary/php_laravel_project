<?php

namespace App\Repositories\References;

use App\Models\References\Countries;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Holidays as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class HolidaysRepository: Репозиторий списка праздничных дней
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class HolidaysRepository extends CoreRepository {

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
            ->join('countries', 'holidays.country_id', '=', 'countries.id')
            ->join('years', 'holidays.year_id', '=', 'years.id')
            ->join('months', 'holidays.month_id', '=', 'months.id')
            ->select('countries.title AS country', 'years.number AS year', 'months.number AS month', 'holidays.holiday', 'holidays.not_work', 'holidays.religion', 'holidays.id')
            ->orderBy('countries.title')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('holidays.holiday')
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
            ->join('countries', 'holidays.country_id', '=', 'countries.id')
            ->join('years', 'holidays.year_id', '=', 'years.id')
            ->join('months', 'holidays.month_id', '=', 'months.id')
            ->select('countries.title AS country', 'years.number AS year', 'months.number AS month', 'holidays.holiday', 'holidays.title', 'holidays.not_work', 'holidays.religion', 'holidays.id')
            ->where('holidays.id', $id)
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

        $columns = ['id', 'country_id', 'year_id', 'month_id', 'holiday', 'title', 'not_work', 'religion', ];

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
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}