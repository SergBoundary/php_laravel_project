<?php

namespace App\Repositories\Accounting;

use App\Models\References\Departments;
use App\Models\References\Objects;
use App\Models\References\Teams;
use App\Models\References\Accounts;
use App\Models\References\Algorithms;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\WorkOrders as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class WorkOrdersRepository: Репозиторий учета нарядов
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class WorkOrdersRepository extends CoreRepository {

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
            ->join('departments', 'work_orders.department_id', '=', 'departments.id')
            ->join('objects', 'work_orders.object_id', '=', 'objects.id')
            ->join('teams', 'work_orders.team_id', '=', 'teams.id')
            ->join('accounts', 'work_orders.account_id', '=', 'accounts.id')
            ->join('algorithms', 'work_orders.algorithm_id', '=', 'algorithms.id')
            ->join('years', 'work_orders.year_id', '=', 'years.id')
            ->join('months', 'work_orders.month_id', '=', 'months.id')
            ->select('departments.abbr AS department', 'objects.abbr AS object', 'teams.abbr AS team', 'accounts.title AS account', 'algorithms.title AS algorithm', 'years.number AS year', 'months.number AS month', 'work_orders.date', 'work_orders.number', 'work_orders.amount', 'work_orders.id')
            ->orderBy('departments.abbr')
            ->orderBy('objects.abbr')
            ->orderBy('teams.abbr')
            ->orderBy('accounts.title')
            ->orderBy('algorithms.title')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('work_orders.date')
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
            ->join('departments', 'work_orders.department_id', '=', 'departments.id')
            ->join('objects', 'work_orders.object_id', '=', 'objects.id')
            ->join('teams', 'work_orders.team_id', '=', 'teams.id')
            ->join('accounts', 'work_orders.account_id', '=', 'accounts.id')
            ->join('algorithms', 'work_orders.algorithm_id', '=', 'algorithms.id')
            ->join('years', 'work_orders.year_id', '=', 'years.id')
            ->join('months', 'work_orders.month_id', '=', 'months.id')
            ->select('departments.abbr AS department', 'objects.abbr AS object', 'teams.abbr AS team', 'accounts.title AS account', 'algorithms.title AS algorithm', 'years.number AS year', 'months.number AS month', 'work_orders.date', 'work_orders.number', 'work_orders.amount', 'work_orders.id')
            ->where('work_orders.id', $id)
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

        $columns = ['id', 'department_id', 'object_id', 'team_id', 'account_id', 'algorithm_id', 'date', 'number', 'amount', 'year_id', 'month_id', ];

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
                $columns = implode(", ", ['id', 'abbr AS department']);
                $result = Departments::selectRaw($columns)
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
                $columns = implode(", ", ['id', 'title AS account']);
                $result = Accounts::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'title AS algorithm']);
                $result = Algorithms::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 6:
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}