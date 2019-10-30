<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Countries;
use App\Models\HumanResources\MigrationStatuses as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class MigrationStatusesRepository: Репозиторий учета миграционного статуса работника в стране
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class MigrationStatusesRepository extends CoreRepository {

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
            ->join('personal_cards', 'migration_statuses.personal_card_id', '=', 'personal_cards.id')
            ->join('countries', 'migration_statuses.country_id', '=', 'countries.id')
            ->select('personal_cards.personal_account AS personal_card', 'countries.title AS country', 'migration_statuses.status_old', 'migration_statuses.status_new', 'migration_statuses.date_opening', 'migration_statuses.date_closing', 'migration_statuses.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('countries.title')
            ->orderBy('migration_statuses.status_old')
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
            ->join('personal_cards', 'migration_statuses.personal_card_id', '=', 'personal_cards.id')
            ->join('countries', 'migration_statuses.country_id', '=', 'countries.id')
            ->select('personal_cards.personal_account AS personal_card', 'countries.title AS country', 'migration_statuses.status_old', 'migration_statuses.status_new', 'migration_statuses.opening_reason', 'migration_statuses.submitted', 'migration_statuses.incomplete', 'migration_statuses.decision_number', 'migration_statuses.decision_date', 'migration_statuses.date_opening', 'migration_statuses.date_closing', 'migration_statuses.closing_reason', 'migration_statuses.id')
            ->where('migration_statuses.id', $id)
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

        $columns = ['id', 'personal_card_id', 'country_id', 'status_old', 'status_new', 'opening_reason', 'submitted', 'incomplete', 'decision_number', 'decision_date', 'date_opening', 'date_closing', 'closing_reason', ];

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