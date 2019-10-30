<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Objects;
use App\Models\References\Teams;
use App\Models\HumanResources\Documents;
use App\Models\HumanResources\Allocations as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AllocationsRepository: Репозиторий учета должностных назначений работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class AllocationsRepository extends CoreRepository {

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
            ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
            ->join('objects', 'allocations.object_id', '=', 'objects.id')
            ->join('teams', 'allocations.team_id', '=', 'teams.id')
            ->join('documents', 'allocations.document_id', '=', 'documents.id')
            ->select('personal_cards.personal_account AS personal_card', 'objects.abbr AS object', 'teams.abbr AS team', 'documents.number AS document', 'allocations.date', 'allocations.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('objects.abbr')
            ->orderBy('teams.abbr')
            ->orderBy('documents.number')
            ->orderBy('allocations.date')
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
            ->join('personal_cards', 'allocations.personal_card_id', '=', 'personal_cards.id')
            ->join('objects', 'allocations.object_id', '=', 'objects.id')
            ->join('teams', 'allocations.team_id', '=', 'teams.id')
            ->join('documents', 'allocations.document_id', '=', 'documents.id')
            ->select('personal_cards.personal_account AS personal_card', 'objects.abbr AS object', 'teams.abbr AS team', 'documents.number AS document', 'allocations.date', 'allocations.id')
            ->where('allocations.id', $id)
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

        $columns = ['id', 'personal_card_id', 'object_id', 'team_id', 'document_id', 'date', ];

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
                $columns = implode(", ", ['id', 'abbr AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'abbr AS team']);
                $result = Teams::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'CONCAT(number, ", ", date) AS document']);
                $result = Documents::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}