<?php

namespace App\Repositories\References;

use App\Models\References\HoursBalanceClassifiers as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class HoursBalanceClassifiersRepository: Справочник. Классификатор графиков распределения рабочих часов в периоде
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class HoursBalanceClassifiersRepository extends CoreRepository {

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
            ->select('hours_balance_classifiers.title', 'hours_balance_classifiers.id')
            ->orderBy('hours_balance_classifiers.title')
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
            ->select('hours_balance_classifiers.title', 'hours_balance_classifiers.monday_day', 'hours_balance_classifiers.tuesday_day', 'hours_balance_classifiers.wednesday_day', 'hours_balance_classifiers.thursday_day', 'hours_balance_classifiers.friday_day', 'hours_balance_classifiers.saturday_day', 'hours_balance_classifiers.sunday_day', 'hours_balance_classifiers.hours_reduction', 'hours_balance_classifiers.hourly_rate', 'hours_balance_classifiers.period', 'hours_balance_classifiers.monday_evening', 'hours_balance_classifiers.tuesday_evening', 'hours_balance_classifiers.wednesday_evening', 'hours_balance_classifiers.thursday_evening', 'hours_balance_classifiers.friday_evening', 'hours_balance_classifiers.saturday_evening', 'hours_balance_classifiers.sunday_evening', 'hours_balance_classifiers.monday_night', 'hours_balance_classifiers.tuesday_night', 'hours_balance_classifiers.wednesday_night', 'hours_balance_classifiers.thursday_night', 'hours_balance_classifiers.friday_night', 'hours_balance_classifiers.saturday_night', 'hours_balance_classifiers.sunday_night', 'hours_balance_classifiers.id')
            ->where('hours_balance_classifiers.id', $id)
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

        $columns = ['id', 'title', 'monday_day', 'tuesday_day', 'wednesday_day', 'thursday_day', 'friday_day', 'saturday_day', 'sunday_day', 'hours_reduction', 'hourly_rate', 'period', 'monday_evening', 'tuesday_evening', 'wednesday_evening', 'thursday_evening', 'friday_evening', 'saturday_evening', 'sunday_evening', 'monday_night', 'tuesday_night', 'wednesday_night', 'thursday_night', 'friday_night', 'saturday_night', 'sunday_night', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}