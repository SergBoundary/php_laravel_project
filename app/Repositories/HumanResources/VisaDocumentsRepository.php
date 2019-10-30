<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\VisaStatuses;
use App\Models\HumanResources\VisaDocuments as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class VisaDocumentsRepository: Репозиторий учета документов работника для получения визы и въезда в страну
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class VisaDocumentsRepository extends CoreRepository {

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
            ->join('personal_cards', 'visa_documents.personal_card_id', '=', 'personal_cards.id')
            ->join('visa_statuses', 'visa_documents.visa_status_id', '=', 'visa_statuses.id')
            ->select('personal_cards.personal_account AS personal_card', 'visa_statuses.country_in_id AS visa_status', 'visa_documents.type', 'visa_documents.number', 'visa_documents.date_issued', 'visa_documents.date_inclusion', 'visa_documents.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('visa_statuses.country_in_id')
            ->orderBy('visa_documents.type')
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
            ->join('personal_cards', 'visa_documents.personal_card_id', '=', 'personal_cards.id')
            ->join('visa_statuses', 'visa_documents.visa_status_id', '=', 'visa_statuses.id')
            ->select('personal_cards.personal_account AS personal_card', 'visa_statuses.country_in_id AS visa_status', 'visa_documents.type', 'visa_documents.number', 'visa_documents.date_issued', 'visa_documents.date_expiration', 'visa_documents.date_inclusion', 'visa_documents.date_seizure', 'visa_documents.id')
            ->where('visa_documents.id', $id)
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

        $columns = ['id', 'personal_card_id', 'visa_status_id', 'type', 'number', 'date_issued', 'date_expiration', 'date_inclusion', 'date_seizure', ];

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
                $columns = implode(", ", ['id', 'CONCAT(country_in, ", ", visa_type, ", ", date_opening, ", ", date_closing) AS visa_status']);
                $result = VisaStatuses::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}