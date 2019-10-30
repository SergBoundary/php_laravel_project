<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\PersonalPasports as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PersonalPasportsRepository: Репозиторий учета паспортов работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class PersonalPasportsRepository extends CoreRepository {

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
            ->join('personal_cards', 'personal_pasports.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_pasports.series', 'personal_pasports.number', 'personal_pasports.expiration date', 'personal_pasports.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('personal_pasports.series')
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
            ->join('personal_cards', 'personal_pasports.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_pasports.series', 'personal_pasports.number', 'personal_pasports.issuing_date', 'personal_pasports.issuing_authority', 'personal_pasports.expiration date', 'personal_pasports.id')
            ->where('personal_pasports.id', $id)
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

        $columns = ['id', 'personal_card_id', 'series', 'number', 'issuing_date', 'issuing_authority', 'expiration date', ];

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
        }

        return $result;
    }

}