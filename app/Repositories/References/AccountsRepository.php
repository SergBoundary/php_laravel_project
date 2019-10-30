<?php

namespace App\Repositories\References;

use App\Models\References\Accounts as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class AccountsRepository: Репозиторий списка бухгалтерских счетов
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class AccountsRepository extends CoreRepository {

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
            ->select('accounts.title', 'accounts.description', 'accounts.currency_status', 'accounts.id')
            ->orderBy('accounts.title')
            ->orderBy('accounts.description')
            ->orderBy('accounts.currency_status')
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
            ->select('accounts.title', 'accounts.description', 'accounts.account_balance_type', 'accounts.balance_type', 'accounts.task', 'accounts.currency_status', 'accounts.transaction_report', 'accounts.choose_account', 'accounts.inventory', 'accounts.inventory_write_off', 'accounts.clients', 'accounts.objects', 'accounts.fixed_assets', 'accounts.main_warehouse', 'accounts.amount_type', 'accounts.type', 'accounts.gross_costs', 'accounts.id')
            ->where('accounts.id', $id)
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

        $columns = ['id', 'title', 'description', 'account_balance_type', 'balance_type', 'task', 'currency_status', 'transaction_report', 'choose_account', 'inventory', 'inventory_write_off', 'clients', 'objects', 'fixed_assets', 'main_warehouse', 'amount_type', 'type', 'gross_costs', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}