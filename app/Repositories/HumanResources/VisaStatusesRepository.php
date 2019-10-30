<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Countries;
use App\Models\References\Countries;
use App\Models\HumanResources\VisaStatuses as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class VisaStatusesRepository: Репозиторий учета виз работника на пребывание в стране
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class VisaStatusesRepository extends CoreRepository {

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
            ->join('personal_cards', 'visa_statuses.personal_card_id', '=', 'personal_cards.id')
            ->join('countries', 'visa_statuses.country_out_id', '=', 'countries.id')
            ->join('countries', 'visa_statuses.country_in_id', '=', 'countries.id')
            ->select('personal_cards.personal_account AS personal_card', 'countries.title AS country_out', 'countries.title AS country_in', 'visa_statuses.visa_type', 'visa_statuses.date_opening', 'visa_statuses.date_closing', 'visa_statuses.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('countries.title')
            ->orderBy('countries.title')
            ->orderBy('visa_statuses.visa_type')
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
            ->join('personal_cards', 'visa_statuses.personal_card_id', '=', 'personal_cards.id')
            ->join('countries', 'visa_statuses.country_out_id', '=', 'countries.id')
            ->join('countries', 'visa_statuses.country_in_id', '=', 'countries.id')
            ->select('personal_cards.personal_account AS personal_card', 'countries.title AS country_out', 'countries.title AS country_in', 'visa_statuses.opening_reason', 'visa_statuses.submitted', 'visa_statuses.incomplete', 'visa_statuses.visa_issued', 'visa_statuses.visa_type', 'visa_statuses.date_opening', 'visa_statuses.date_closing', 'visa_statuses.closing_reason', 'visa_statuses.id')
            ->where('visa_statuses.id', $id)
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

        $columns = ['id', 'personal_card_id', 'country_out_id', 'country_in_id', 'opening_reason', 'submitted', 'incomplete', 'visa_issued', 'visa_type', 'date_opening', 'date_closing', 'closing_reason', ];

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
                $columns = implode(", ", ['id', 'CONCAT(personal_account, ", ", surname, ", ", first_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS country_out']);
                $result = Countries::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS country_in']);
                $result = Countries::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}