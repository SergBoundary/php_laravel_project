<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\Documents;
use App\Models\HumanResources\ManningOrders;
use App\Models\HumanResources\Provisions as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class ProvisionsRepository: Репозиторий учета материального обеспечения работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class ProvisionsRepository extends CoreRepository {

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
            ->join('documents', 'provisions.document_id', '=', 'documents.id')
            ->join('manning_orders', 'provisions.manning_orders_id', '=', 'manning_orders.id')
            ->select('documents.number AS document', 'manning_orders.assignment_date AS manning_orders', 'provisions.amount', 'provisions.provision_date', 'provisions.return_date', 'provisions.id')
            ->orderBy('documents.number')
            ->orderBy('manning_orders.assignment_date')
            ->orderBy('provisions.amount')
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
            ->join('documents', 'provisions.document_id', '=', 'documents.id')
            ->join('manning_orders', 'provisions.manning_orders_id', '=', 'manning_orders.id')
            ->select('documents.number AS document', 'manning_orders.assignment_date AS manning_orders', 'provisions.date_from', 'provisions.date_to', 'provisions.amount', 'provisions.rationale_title', 'provisions.provision_date', 'provisions.return_date', 'provisions.id')
            ->where('provisions.id', $id)
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

        $columns = ['id', 'document_id', 'manning_orders_id', 'date_from', 'date_to', 'amount', 'rationale_title', 'provision_date', 'return_date', ];

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
                $columns = implode(", ", ['id', 'CONCAT(assignment_date, ", ", assignment_order, ", ", resignation_date) AS manning_orders']);
                $result = ManningOrders::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}