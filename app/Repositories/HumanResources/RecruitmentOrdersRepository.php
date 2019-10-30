<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\Documents;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\DismissalReasons;
use App\Models\HumanResources\RecruitmentOrders as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class RecruitmentOrdersRepository: Репозиторий учета найма и увольнений работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class RecruitmentOrdersRepository extends CoreRepository {

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
            ->join('documents', 'recruitment_orders.document_id', '=', 'documents.id')
            ->join('personal_cards', 'recruitment_orders.personal_card_id', '=', 'personal_cards.id')
            ->join('dismissal_reasons', 'recruitment_orders.dismissal_reason_id', '=', 'dismissal_reasons.id')
            ->select('documents.number AS document', 'personal_cards.personal_account AS personal_card', 'dismissal_reasons.title AS dismissal_reason', 'recruitment_orders.employment_date', 'recruitment_orders.employment_order', 'recruitment_orders.dismissal_date', 'recruitment_orders.id')
            ->orderBy('documents.number')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('dismissal_reasons.title')
            ->orderBy('recruitment_orders.employment_date')
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
            ->join('documents', 'recruitment_orders.document_id', '=', 'documents.id')
            ->join('personal_cards', 'recruitment_orders.personal_card_id', '=', 'personal_cards.id')
            ->join('dismissal_reasons', 'recruitment_orders.dismissal_reason_id', '=', 'dismissal_reasons.id')
            ->select('documents.number AS document', 'personal_cards.personal_account AS personal_card', 'dismissal_reasons.title AS dismissal_reason', 'recruitment_orders.employment_date', 'recruitment_orders.employment_order', 'recruitment_orders.probation', 'recruitment_orders.dismissal_date', 'recruitment_orders.dismissal_order', 'recruitment_orders.id')
            ->where('recruitment_orders.id', $id)
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

        $columns = ['id', 'document_id', 'personal_card_id', 'employment_date', 'employment_order', 'probation', 'dismissal_date', 'dismissal_order', 'dismissal_reason_id', ];

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
                $columns = implode(", ", ['id', 'title AS dismissal_reason']);
                $result = DismissalReasons::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}