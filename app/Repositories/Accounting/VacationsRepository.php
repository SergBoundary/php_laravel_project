<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\Documents;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\AbsenceClassifiers;
use App\Models\References\PhraseLists;
use App\Models\Accounting\Vacations as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class VacationsRepository: Репозиторий учета отпусков
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class VacationsRepository extends CoreRepository {

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
            ->join('documents', 'vacations.document_id', '=', 'documents.id')
            ->join('personal_cards', 'vacations.personal_card_id', '=', 'personal_cards.id')
            ->join('absence_classifiers', 'vacations.absence_classifier_id', '=', 'absence_classifiers.id')
            ->join('phrase_lists', 'vacations.phrase_list_id', '=', 'phrase_lists.id')
            ->select('documents.number AS document', 'personal_cards.personal_account AS personal_card', 'absence_classifiers.accrual_id AS absence_classifier', 'phrase_lists.title AS phrase_list', 'vacations.start', 'vacations.expiry', 'vacations.vacation_pay', 'vacations.id')
            ->orderBy('documents.number')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('absence_classifiers.accrual_id')
            ->orderBy('phrase_lists.title')
            ->orderBy('vacations.start')
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
            ->join('documents', 'vacations.document_id', '=', 'documents.id')
            ->join('personal_cards', 'vacations.personal_card_id', '=', 'personal_cards.id')
            ->join('absence_classifiers', 'vacations.absence_classifier_id', '=', 'absence_classifiers.id')
            ->join('phrase_lists', 'vacations.phrase_list_id', '=', 'phrase_lists.id')
            ->select('documents.number AS document', 'personal_cards.personal_account AS personal_card', 'absence_classifiers.accrual_id AS absence_classifier', 'phrase_lists.title AS phrase_list', 'vacations.period_start', 'vacations.period_expiry', 'vacations.period', 'vacations.start', 'vacations.expiry', 'vacations.work_days', 'vacations.work_hours', 'vacations.vacation_pay', 'vacations.id')
            ->where('vacations.id', $id)
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

        $columns = ['id', 'document_id', 'personal_card_id', 'absence_classifier_id', 'period_start', 'period_expiry', 'period', 'start', 'expiry', 'phrase_list_id', 'work_days', 'work_hours', 'vacation_pay', ];

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
                $columns = implode(", ", ['id', 'CONCAT(personal_account, ", ", surname, ", ", first_name) AS personal_card']);
                $result = PersonalCards::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'CONCAT(accrual, ", ", abbr) AS absence_classifier']);
                $result = AbsenceClassifiers::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'title AS phrase_list']);
                $result = PhraseLists::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}