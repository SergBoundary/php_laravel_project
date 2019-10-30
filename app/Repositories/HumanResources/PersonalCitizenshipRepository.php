<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Countries;
use App\Models\HumanResources\PersonalCitizenship as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PersonalCitizenshipRepository: Репозиторий учета гражданств работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class PersonalCitizenshipRepository extends CoreRepository {

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
            ->join('personal_cards', 'personal_citizenship.personal_card_id', '=', 'personal_cards.id')
            ->join('countries', 'personal_citizenship.country_id', '=', 'countries.id')
            ->select('personal_cards.personal_account AS personal_card', 'countries.title AS country', 'personal_citizenship.start', 'personal_citizenship.expiry', 'personal_citizenship.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('countries.title')
            ->orderBy('personal_citizenship.start')
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
            ->join('personal_cards', 'personal_citizenship.personal_card_id', '=', 'personal_cards.id')
            ->join('countries', 'personal_citizenship.country_id', '=', 'countries.id')
            ->select('personal_cards.personal_account AS personal_card', 'countries.title AS country', 'personal_citizenship.start', 'personal_citizenship.expiry', 'personal_citizenship.id')
            ->where('personal_citizenship.id', $id)
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

        $columns = ['id', 'personal_card_id', 'country_id', 'start', 'expiry', ];

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
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS country']);
                $result = Countries::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}