<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Banks;
use App\Models\HumanResources\SalaryCards as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class SalaryCardsRepository: Репозиторий учета зарплатных карт работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class SalaryCardsRepository extends CoreRepository {

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
            ->join('personal_cards', 'salary_cards.personal_card_id', '=', 'personal_cards.id')
            ->join('banks', 'salary_cards.bank_id', '=', 'banks.id')
            ->select('personal_cards.personal_account AS personal_card', 'banks.title AS bank', 'salary_cards.payment_card', 'salary_cards.expiry', 'salary_cards.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('banks.title')
            ->orderBy('salary_cards.payment_card')
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
            ->join('personal_cards', 'salary_cards.personal_card_id', '=', 'personal_cards.id')
            ->join('banks', 'salary_cards.bank_id', '=', 'banks.id')
            ->select('personal_cards.personal_account AS personal_card', 'banks.title AS bank', 'salary_cards.payment_card', 'salary_cards.expiry', 'salary_cards.id')
            ->where('salary_cards.id', $id)
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

        $columns = ['id', 'personal_card_id', 'bank_id', 'payment_card', 'expiry', ];

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
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", commission) AS bank']);
                $result = Banks::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}