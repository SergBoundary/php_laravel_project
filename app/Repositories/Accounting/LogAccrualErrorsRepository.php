<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\Accounting\LogAccrualErrors as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class LogAccrualErrorsRepository: Репозиторий ошибок в расчете начислений работникам
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class LogAccrualErrorsRepository extends CoreRepository {

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
            ->join('personal_cards', 'log_accrual_errors.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'log_accrual_errors.message', 'log_accrual_errors.error_type', 'log_accrual_errors.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('log_accrual_errors.message')
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
            ->join('personal_cards', 'log_accrual_errors.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'log_accrual_errors.message', 'log_accrual_errors.error_type', 'log_accrual_errors.id')
            ->where('log_accrual_errors.id', $id)
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

        $columns = ['id', 'personal_card_id', 'message', 'error_type', ];

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