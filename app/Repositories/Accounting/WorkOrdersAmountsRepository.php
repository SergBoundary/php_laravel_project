<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\Accounting\WorkOrders;
use App\Models\References\Pieceworks;
use App\Models\References\Accounts;
use App\Models\References\Objects;
use App\Models\References\Algorithms;
use App\Models\Accounting\WorkOrdersAmounts as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class WorkOrdersAmountsRepository: Репозиторий учета сумм нарядов
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class WorkOrdersAmountsRepository extends CoreRepository {

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
            ->join('personal_cards', 'work_orders_amounts.personal_card_id', '=', 'personal_cards.id')
            ->join('work_orders', 'work_orders_amounts.work_order_id', '=', 'work_orders.id')
            ->join('pieceworks', 'work_orders_amounts.piecework_id', '=', 'pieceworks.id')
            ->join('accounts', 'work_orders_amounts.account_id', '=', 'accounts.id')
            ->join('objects', 'work_orders_amounts.object_id', '=', 'objects.id')
            ->join('algorithms', 'work_orders_amounts.algorithm_id', '=', 'algorithms.id')
            ->select('personal_cards.personal_account AS personal_card', 'work_orders.date AS work_order', 'pieceworks.title AS piecework', 'accounts.title AS account', 'objects.abbr AS object', 'algorithms.title AS algorithm', 'work_orders_amounts.amount', 'work_orders_amounts.holidays_amount', 'work_orders_amounts.hours', 'work_orders_amounts.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('work_orders.date')
            ->orderBy('pieceworks.title')
            ->orderBy('accounts.title')
            ->orderBy('objects.abbr')
            ->orderBy('algorithms.title')
            ->orderBy('work_orders_amounts.amount')
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
            ->join('personal_cards', 'work_orders_amounts.personal_card_id', '=', 'personal_cards.id')
            ->join('work_orders', 'work_orders_amounts.work_order_id', '=', 'work_orders.id')
            ->join('pieceworks', 'work_orders_amounts.piecework_id', '=', 'pieceworks.id')
            ->join('accounts', 'work_orders_amounts.account_id', '=', 'accounts.id')
            ->join('objects', 'work_orders_amounts.object_id', '=', 'objects.id')
            ->join('algorithms', 'work_orders_amounts.algorithm_id', '=', 'algorithms.id')
            ->select('personal_cards.personal_account AS personal_card', 'work_orders.date AS work_order', 'pieceworks.title AS piecework', 'accounts.title AS account', 'objects.abbr AS object', 'algorithms.title AS algorithm', 'work_orders_amounts.quantity', 'work_orders_amounts.price', 'work_orders_amounts.amount', 'work_orders_amounts.holidays_amount', 'work_orders_amounts.hours', 'work_orders_amounts.id')
            ->where('work_orders_amounts.id', $id)
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

        $columns = ['id', 'personal_card_id', 'work_order_id', 'piecework_id', 'account_id', 'object_id', 'algorithm_id', 'quantity', 'price', 'amount', 'holidays_amount', 'hours', ];

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
                $columns = implode(", ", ['id', 'CONCAT(date, ", ", number, ", ", amount) AS work_order']);
                $result = WorkOrders::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", price) AS piecework']);
                $result = Pieceworks::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'title AS account']);
                $result = Accounts::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'abbr AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'title AS algorithm']);
                $result = Algorithms::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}