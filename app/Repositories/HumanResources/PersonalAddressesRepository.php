<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Cities;
use App\Models\HumanResources\PersonalAddresses as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PersonalAddressesRepository: Репозиторий учета адресов работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class PersonalAddressesRepository extends CoreRepository {

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
            ->join('personal_cards', 'personal_addresses.personal_card_id', '=', 'personal_cards.id')
            ->join('cities', 'personal_addresses.city_id', '=', 'cities.id')
            ->select('personal_cards.personal_account AS personal_card', 'cities.title AS city', 'personal_addresses.postcode', 'personal_addresses.street', 'personal_addresses.house', 'personal_addresses.apartment', 'personal_addresses.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('cities.title')
            ->orderBy('personal_addresses.postcode')
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
            ->join('personal_cards', 'personal_addresses.personal_card_id', '=', 'personal_cards.id')
            ->join('cities', 'personal_addresses.city_id', '=', 'cities.id')
            ->select('personal_cards.personal_account AS personal_card', 'cities.title AS city', 'personal_addresses.postcode', 'personal_addresses.street', 'personal_addresses.house', 'personal_addresses.apartment', 'personal_addresses.id')
            ->where('personal_addresses.id', $id)
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

        $columns = ['id', 'personal_card_id', 'postcode', 'city_id', 'street', 'house', 'apartment', ];

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
                $columns = implode(", ", ['id', 'title AS city']);
                $result = Cities::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}