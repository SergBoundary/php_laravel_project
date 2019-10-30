<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\AbsenceClassifiers;
use App\Models\Accounting\AbsenceFromWorks as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AbsenceFromWorksRepository: Репозиторий учета отсутствия на работе
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class AbsenceFromWorksRepository extends CoreRepository {

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
            ->join('personal_cards', 'absence_from_works.personal_card_id', '=', 'personal_cards.id')
            ->join('absence_classifiers', 'absence_from_works.absence_classifier_id', '=', 'absence_classifiers.id')
            ->select('personal_cards.personal_account AS personal_card', 'absence_classifiers.accrual_id AS absence_classifier', 'absence_from_works.start', 'absence_from_works.expiry', 'absence_from_works.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('absence_classifiers.accrual_id')
            ->orderBy('absence_from_works.start')
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
            ->join('personal_cards', 'absence_from_works.personal_card_id', '=', 'personal_cards.id')
            ->join('absence_classifiers', 'absence_from_works.absence_classifier_id', '=', 'absence_classifiers.id')
            ->select('personal_cards.personal_account AS personal_card', 'absence_classifiers.accrual_id AS absence_classifier', 'absence_from_works.start', 'absence_from_works.expiry', 'absence_from_works.rationale', 'absence_from_works.id')
            ->where('absence_from_works.id', $id)
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

        $columns = ['id', 'personal_card_id', 'absence_classifier_id', 'start', 'expiry', 'rationale', ];

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
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", abbr) AS absence_classifier']);
                $result = AbsenceClassifiers::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}