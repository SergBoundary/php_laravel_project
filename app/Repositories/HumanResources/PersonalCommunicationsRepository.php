<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\CommunicationTypes;
use App\Models\HumanResources\PersonalCommunications as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PersonalCommunicationsRepository: Репозиторий учета способов коммуникации с работником
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class PersonalCommunicationsRepository extends CoreRepository {

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
            ->join('personal_cards', 'personal_communications.personal_card_id', '=', 'personal_cards.id')
            ->join('communication_types', 'personal_communications.communication_type_id', '=', 'communication_types.id')
            ->select('personal_cards.personal_account AS personal_card', 'communication_types.title AS communication_type', 'personal_communications.content', 'personal_communications.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('communication_types.title')
            ->orderBy('personal_communications.content')
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
            ->join('personal_cards', 'personal_communications.personal_card_id', '=', 'personal_cards.id')
            ->join('communication_types', 'personal_communications.communication_type_id', '=', 'communication_types.id')
            ->select('personal_cards.personal_account AS personal_card', 'communication_types.title AS communication_type', 'personal_communications.content', 'personal_communications.id')
            ->where('personal_communications.id', $id)
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

        $columns = ['id', 'personal_card_id', 'communication_type_id', 'content', ];

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
                $columns = implode(", ", ['id', 'title AS communication_type']);
                $result = CommunicationTypes::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}