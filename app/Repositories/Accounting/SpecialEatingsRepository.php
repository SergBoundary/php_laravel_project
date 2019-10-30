<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\SpecialEatings as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class SpecialEatingsRepository: Репозиторий учета специального питания
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class SpecialEatingsRepository extends CoreRepository {

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
            ->join('personal_cards', 'special_eatings.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'special_eatings.year_id', '=', 'years.id')
            ->join('months', 'special_eatings.month_id', '=', 'months.id')
            ->select('personal_cards.personal_account AS personal_card', 'years.number AS year', 'months.number AS month', 'special_eatings.residual_amount', 'special_eatings.amount', 'special_eatings.hours', 'special_eatings.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('special_eatings.residual_amount')
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
            ->join('personal_cards', 'special_eatings.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'special_eatings.year_id', '=', 'years.id')
            ->join('months', 'special_eatings.month_id', '=', 'months.id')
            ->select('personal_cards.personal_account AS personal_card', 'years.number AS year', 'months.number AS month', 'special_eatings.residual_amount', 'special_eatings.amount', 'special_eatings.hours', 'special_eatings.unit_price', 'special_eatings.unit_quantity', 'special_eatings.id')
            ->where('special_eatings.id', $id)
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

        $columns = ['id', 'personal_card_id', 'year_id', 'month_id', 'residual_amount', 'amount', 'hours', 'unit_price', 'unit_quantity', ];

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
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}