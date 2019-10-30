<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\ManningTables;
use App\Models\HumanResources\ManningOrders as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class ManningOrdersRepository: Репозиторий учета должностных назначений
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class ManningOrdersRepository extends CoreRepository {

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
            ->join('personal_cards', 'manning_orders.personal_card_id', '=', 'personal_cards.id')
            ->join('manning_tables', 'manning_orders.manning_table_id', '=', 'manning_tables.id')
            ->select('personal_cards.personal_account AS personal_card', 'manning_tables.department_id AS manning_table', 'manning_orders.assignment_date', 'manning_orders.assignment_order', 'manning_orders.resignation_date', 'manning_orders.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('manning_tables.department_id')
            ->orderBy('manning_orders.assignment_date')
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
            ->join('personal_cards', 'manning_orders.personal_card_id', '=', 'personal_cards.id')
            ->join('manning_tables', 'manning_orders.manning_table_id', '=', 'manning_tables.id')
            ->select('personal_cards.personal_account AS personal_card', 'manning_tables.department_id AS manning_table', 'manning_orders.assignment_date', 'manning_orders.assignment_order', 'manning_orders.resignation_date', 'manning_orders.resignation_order', 'manning_orders.salary', 'manning_orders.tariff', 'manning_orders.id')
            ->where('manning_orders.id', $id)
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

        $columns = ['id', 'personal_card_id', 'manning_table_id', 'assignment_date', 'assignment_order', 'resignation_date', 'resignation_order', 'salary', 'tariff', ];

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
                $columns = implode(", ", ['id', 'CONCAT(department, ", ", position, ", ", rank) AS manning_table']);
                $result = ManningTables::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}