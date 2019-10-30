<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\Documents;
use App\Models\References\DocumentTypes;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Users;
use App\Models\HumanResources\Users;
use App\Models\HumanResources\Documents as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class DocumentsRepository: Репозиторий учета кадровых документов
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class DocumentsRepository extends CoreRepository {

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
            ->join('documents', 'documents.document_id', '=', 'documents.id')
            ->join('document_types', 'documents.document_type_id', '=', 'document_types.id')
            ->join('personal_cards', 'documents.personal_card_id', '=', 'personal_cards.id')
            ->join('users', 'documents.create_user_id', '=', 'users.id')
            ->join('users', 'documents.editor_user_id', '=', 'users.id')
            ->select('documents.number AS document', 'document_types.abbr AS document_type', 'personal_cards.personal_account AS personal_card', 'users.name AS create_user', 'users.name AS editor_user', 'documents.date', 'documents.annotation', 'documents.id')
            ->orderBy('documents.number')
            ->orderBy('document_types.abbr')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('users.name')
            ->orderBy('users.name')
            ->orderBy('documents.date')
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
            ->join('documents', 'documents.document_id', '=', 'documents.id')
            ->join('document_types', 'documents.document_type_id', '=', 'document_types.id')
            ->join('personal_cards', 'documents.personal_card_id', '=', 'personal_cards.id')
            ->join('users', 'documents.create_user_id', '=', 'users.id')
            ->join('users', 'documents.editor_user_id', '=', 'users.id')
            ->select('documents.number AS document', 'document_types.abbr AS document_type', 'personal_cards.personal_account AS personal_card', 'users.name AS create_user', 'users.name AS editor_user', 'documents.number', 'documents.date', 'documents.annotation', 'documents.description', 'documents.print', 'documents.id')
            ->where('documents.id', $id)
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

        $columns = ['id', 'document_id', 'number', 'date', 'annotation', 'description', 'print', 'document_type_id', 'personal_card_id', 'create_user_id', 'editor_user_id', ];

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
                $columns = implode(", ", ['id', 'CONCAT(number, ", ", date) AS document']);
                $result = Documents::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'CONCAT(abbr, ", ", standart_status) AS document_type']);
                $result = DocumentTypes::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'CONCAT(personal_account, ", ", surname, ", ", first_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'CONCAT(name, ", ", email) AS create_user']);
                $result = Users::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'CONCAT(name, ", ", email) AS editor_user']);
                $result = Users::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}