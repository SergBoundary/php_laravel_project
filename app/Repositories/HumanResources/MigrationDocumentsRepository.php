<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\MigrationStatuses;
use App\Models\HumanResources\MigrationDocuments as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class MigrationDocumentsRepository: Репозиторий учета документов работника для легализации пребывания в стране
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class MigrationDocumentsRepository extends CoreRepository {

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
            ->join('personal_cards', 'migration_documents.personal_card_id', '=', 'personal_cards.id')
            ->join('migration_statuses', 'migration_documents.migration_status_id', '=', 'migration_statuses.id')
            ->select('personal_cards.personal_account AS personal_card', 'migration_statuses.country_id AS migration_status', 'migration_documents.type', 'migration_documents.number', 'migration_documents.date_issued', 'migration_documents.date_inclusion', 'migration_documents.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('migration_statuses.country_id')
            ->orderBy('migration_documents.type')
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
            ->join('personal_cards', 'migration_documents.personal_card_id', '=', 'personal_cards.id')
            ->join('migration_statuses', 'migration_documents.migration_status_id', '=', 'migration_statuses.id')
            ->select('personal_cards.personal_account AS personal_card', 'migration_statuses.country_id AS migration_status', 'migration_documents.type', 'migration_documents.number', 'migration_documents.date_issued', 'migration_documents.date_expiration', 'migration_documents.date_inclusion', 'migration_documents.date_seizure', 'migration_documents.id')
            ->where('migration_documents.id', $id)
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

        $columns = ['id', 'personal_card_id', 'migration_status_id', 'type', 'number', 'date_issued', 'date_expiration', 'date_inclusion', 'date_seizure', ];

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
                $columns = implode(", ", ['id', 'CONCAT(country, ", ", status_new, ", ", date_opening, ", ", date_closing) AS migration_status']);
                $result = MigrationStatuses::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}