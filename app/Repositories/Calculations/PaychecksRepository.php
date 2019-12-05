<?php

namespace App\Repositories\Calculations;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Calculations\Paychecks as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class PaychecksRepository: Репозиторий обслуживания расчетного листа по заработной плате
 *
 * @author SeBo
 *
 * @package App\Repositories\Calculations
 */
class PaychecksRepository extends CoreRepository {

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
		
		$user = Auth::user();
		
		if($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'paychecks.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'paychecks.year_id', '=', 'years.id')
                ->join('months', 'paychecks.month_id', '=', 'months.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'paychecks.balance_start', 'paychecks.hourly', 'paychecks.piecework', 'paychecks.accrual', 'paychecks.retention', 'paychecks.issued_by', 'paychecks.give_out', 'paychecks.debt', 'paychecks.id')
				->where('personal_cards.id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('paychecks.balance_start')
                ->get();
		} else {
            $result = $this->startConditions()
                ->join('personal_cards', 'paychecks.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'paychecks.year_id', '=', 'years.id')
                ->join('months', 'paychecks.month_id', '=', 'months.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'paychecks.balance_start', 'paychecks.hourly', 'paychecks.piecework', 'paychecks.accrual', 'paychecks.retention', 'paychecks.issued_by', 'paychecks.give_out', 'paychecks.debt', 'paychecks.id')
                ->orderBy('personal_cards.surname')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('paychecks.balance_start')
                ->get();
		}

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
            ->join('personal_cards', 'paychecks.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'paychecks.year_id', '=', 'years.id')
            ->join('months', 'paychecks.month_id', '=', 'months.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'paychecks.balance_start', 'paychecks.hourly', 'paychecks.piecework', 'paychecks.accrual', 'paychecks.retention', 'paychecks.issued_by', 'paychecks.give_out', 'paychecks.debt', 'paychecks.id')
            ->where('paychecks.id', $id)
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

        $columns = ['id', 'personal_card_id', 'year_id', 'month_id', 'balance_start', 'hourly', 'piecework', 'accrual', 'retention', 'issued_by', 'give_out', 'debt', ];

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