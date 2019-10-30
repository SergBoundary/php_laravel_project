<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\Countries;
use App\Models\HumanResources\BorderCrossings as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class BorderCrossingsRepository: Репозиторий учета пересечения границы страны пребывания работником
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class BorderCrossingsRepository extends CoreRepository {

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
            ->join('personal_cards', 'border_crossings.personal_card_id', '=', 'personal_cards.id')
            ->join('countries AS out', 'border_crossings.country_out_id', '=', 'out.id')
            ->join('countries AS in', 'border_crossings.country_in_id', '=', 'in.id')
            ->select('personal_cards.personal_account AS personal_card', 'out.title AS country_out', 'in.title AS country_in', 'border_crossings.date', 'border_crossings.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('border_crossings.date')
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
            ->join('personal_cards', 'border_crossings.personal_card_id', '=', 'personal_cards.id')
            ->join('countries', 'border_crossings.country_out_id', '=', 'countries.id')
            ->join('countries', 'border_crossings.country_in_id', '=', 'countries.id')
            ->select('personal_cards.personal_account AS personal_card', 'countries.title AS country_out', 'countries.title AS country_in', 'border_crossings.date', 'border_crossings.comment', 'border_crossings.id')
            ->where('border_crossings.id', $id)
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

        $columns = ['id', 'personal_card_id', 'country_out_id', 'country_in_id', 'date', 'comment', ];

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
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS country_out']);
                $result = Countries::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS country_in']);
                $result = Countries::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}