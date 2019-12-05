<?php

namespace App\Repositories\Calculations;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Calculations\Payrolls as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PayrollsRepository: Репозиторий обслуживания расчета заработной платы
 *
 * @author SeBo
 *
 * @package App\Repositories\Calculations
 */
class PayrollsRepository extends CoreRepository {

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
            ->join('personal_cards', 'payrolls.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'payrolls.year_id', '=', 'years.id')
            ->join('months', 'payrolls.month_id', '=', 'months.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'payrolls.accrual', 'payrolls.retention', 'payrolls.give_out', 'payrolls.debt', 'payrolls.id')
            ->orderBy('personal_cards.surname')
            ->orderBy('years.number')
            ->orderBy('months.title')
            ->orderBy('payrolls.accrual')
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
            ->join('personal_cards', 'payrolls.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'payrolls.year_id', '=', 'years.id')
            ->join('months', 'payrolls.month_id', '=', 'months.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'payrolls.accrual', 'payrolls.retention', 'payrolls.give_out', 'payrolls.debt', 'payrolls.id')
            ->where('payrolls.id', $id)
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

        $columns = ['id', 'personal_card_id', 'year_id', 'month_id', 'accrual', 'retention', 'give_out', 'debt', ];

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
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}