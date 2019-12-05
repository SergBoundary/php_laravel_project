<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Teams as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class TeamsRepository: Репозиторий учета формирования бригад
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class TeamsRepository extends CoreRepository {

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
                ->join('personal_cards', 'teams.personal_card_id', '=', 'personal_cards.id')
                ->join('allocations', 'teams.id', '=', 'allocations.team_id')
                ->select('personal_cards.personal_account AS personal_card', 'teams.title', 'teams.abbr', 'teams.start', 'teams.expiry', 'teams.id')
                ->where('allocations.personal_card_id', $user['id'])
                ->orderBy('personal_cards.personal_account')
                ->orderBy('teams.abbr')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'teams.personal_card_id', '=', 'personal_cards.id')
                ->select('personal_cards.personal_account AS personal_card', 'teams.title', 'teams.abbr', 'teams.start', 'teams.expiry', 'teams.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('personal_cards.personal_account')
                ->orderBy('teams.abbr')
                ->get();
        } else {
            $result = $this->startConditions()
                ->join('personal_cards', 'teams.personal_card_id', '=', 'personal_cards.id')
                ->select('personal_cards.personal_account AS personal_card', 'teams.title', 'teams.abbr', 'teams.start', 'teams.expiry', 'teams.id')
                ->orderBy('personal_cards.personal_account')
                ->orderBy('teams.abbr')
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
            ->join('personal_cards', 'teams.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'teams.title', 'teams.abbr', 'teams.start', 'teams.expiry', 'teams.id')
            ->where('teams.id', $id)
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

        $columns = ['id', 'personal_card_id', 'title', 'abbr', 'start', 'expiry', ];

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
        }

        return $result;
    }

}