<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class PersonalCardsRepository: Репозиторий учета неизменяемых персональных данных
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class PersonalCardsRepository extends CoreRepository {

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

        if($user['access'] == 4) {
            $result = $this->startConditions()
                ->select('personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.born_date', 'personal_cards.id')
                ->where('personal_cards.id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('allocations', 'personal_cards.id', '=', 'allocations.personal_card_id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.born_date', 'personal_cards.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->get();
        } else {
            $result = $this->startConditions()
                ->select('personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.born_date', 'personal_cards.id')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
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
            ->select('personal_cards.personal_account', 'personal_cards.tax_number', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.second_name', 'personal_cards.full_name_latina', 'personal_cards.sex', 'personal_cards.born_date', 'personal_cards.photo_url', 'personal_cards.id')
            ->where('personal_cards.id', $id)
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

        $columns = ['id', 'personal_account', 'tax_number', 'surname', 'first_name', 'second_name', 'full_name_latina', 'sex', 'born_date', 'photo_url', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}