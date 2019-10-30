<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\MilitaryAccounting as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class MilitaryAccountingRepository: Репозиторий воинского учета работников
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class MilitaryAccountingRepository extends CoreRepository {

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
            ->join('personal_cards', 'military_accounting.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'military_accounting.accounting_group', 'military_accounting.military_rank', 'military_accounting.military_suitability', 'military_accounting.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('military_accounting.accounting_group')
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
            ->join('personal_cards', 'military_accounting.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'military_accounting.accounting_group', 'military_accounting.accounting_category', 'military_accounting.composition', 'military_accounting.military_rank', 'military_accounting.military_specialty', 'military_accounting.military_suitability', 'military_accounting.military_commissariat', 'military_accounting.id')
            ->where('military_accounting.id', $id)
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

        $columns = ['id', 'personal_card_id', 'accounting_group', 'accounting_category', 'composition', 'military_rank', 'military_specialty', 'military_suitability', 'military_commissariat', ];

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