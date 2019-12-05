<?php

namespace App\Repositories\Accounting;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Objects;
use App\Models\Accounting\Pieceworks as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class PieceworksRepository: Репозиторий учета сдельных работ
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class PieceworksRepository extends CoreRepository {

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
                ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'pieceworks.year_id', '=', 'years.id')
                ->join('months', 'pieceworks.month_id', '=', 'months.id')
                ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'pieceworks.type', 'pieceworks.unit', 'pieceworks.quantity', 'pieceworks.price', 'pieceworks.id')
                ->where('personal_cards.id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('pieceworks.type')
                ->get();
        } elseif($user['access'] == 3) {
            $result = $this->startConditions()
                ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'pieceworks.year_id', '=', 'years.id')
                ->join('months', 'pieceworks.month_id', '=', 'months.id')
                ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
                ->join('allocations', 'personal_cards.id', '=', 'allocations.personal_card_id')
                ->join('teams', 'allocations.team_id', '=', 'teams.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'pieceworks.type', 'pieceworks.unit', 'pieceworks.quantity', 'pieceworks.price', 'pieceworks.id')
                ->where('teams.personal_card_id', $user['id'])
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('pieceworks.type')
                ->get();
        } else {
            $result = $this->startConditions()
                ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
                ->join('years', 'pieceworks.year_id', '=', 'years.id')
                ->join('months', 'pieceworks.month_id', '=', 'months.id')
                ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
                ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'pieceworks.type', 'pieceworks.unit', 'pieceworks.quantity', 'pieceworks.price', 'pieceworks.id')
                ->orderBy('personal_cards.surname')
                ->orderBy('personal_cards.first_name')
                ->orderBy('years.number')
                ->orderBy('months.title')
                ->orderBy('objects.abbr')
                ->orderBy('pieceworks.type')
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
            ->join('personal_cards', 'pieceworks.personal_card_id', '=', 'personal_cards.id')
            ->join('years', 'pieceworks.year_id', '=', 'years.id')
            ->join('months', 'pieceworks.month_id', '=', 'months.id')
            ->join('objects', 'pieceworks.object_id', '=', 'objects.id')
            ->select('personal_cards.personal_account AS personal_card', 'personal_cards.surname AS surname', 'personal_cards.first_name AS first_name', 'years.number AS year', 'months.title AS month', 'objects.title AS object', 'pieceworks.type', 'pieceworks.unit', 'pieceworks.quantity', 'pieceworks.price', 'pieceworks.id')
            ->where('pieceworks.id', $id)
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

        $columns = ['id', 'personal_card_id', 'year_id', 'month_id', 'object_id', 'type', 'unit', 'quantity', 'price', ];

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
                $user = Auth::user();

                if($user['access'] == 4) {
                    $result = FALSE;
                } elseif($user['access'] == 3) {
                    $result = PersonalCards::join('allocations', 'personal_cards.id', '=', 'allocations.personal_card_id')
                        ->join('teams', 'allocations.team_id', '=', 'teams.id')
                        ->select('personal_cards.id', 'personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name')
                        ->where('teams.personal_card_id', $user['id'])
                        ->distinct()
                        ->toBase()
                        ->get();
                } else {
                    $result = PersonalCards::select('personal_cards.id', 'personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name')
                        ->distinct()
                        ->toBase()
                        ->get();
                }
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
            case 3:
                $columns = implode(", ", ['id', 'title AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();
                break;
        }

        return $result;
    }

}