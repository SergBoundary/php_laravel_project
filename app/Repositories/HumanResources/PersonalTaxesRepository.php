<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\TaxOffices;
use App\Models\References\TaxRecipients;
use App\Models\HumanResources\PersonalTaxes as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PersonalTaxesRepository: Репозиторий учета налоговой информации работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class PersonalTaxesRepository extends CoreRepository {

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
            ->join('personal_cards', 'personal_taxes.personal_card_id', '=', 'personal_cards.id')
            ->join('tax_offices', 'personal_taxes.tax_office_id', '=', 'tax_offices.id')
            ->join('tax_recipients', 'personal_taxes.tax_recipient_id', '=', 'tax_recipients.id')
            ->select('personal_cards.personal_account AS personal_card', 'tax_offices.title AS tax_office', 'tax_recipients.title AS tax_recipient', 'personal_taxes.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('tax_offices.title')
            ->orderBy('tax_recipients.title')
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
            ->join('personal_cards', 'personal_taxes.personal_card_id', '=', 'personal_cards.id')
            ->join('tax_offices', 'personal_taxes.tax_office_id', '=', 'tax_offices.id')
            ->join('tax_recipients', 'personal_taxes.tax_recipient_id', '=', 'tax_recipients.id')
            ->select('personal_cards.personal_account AS personal_card', 'tax_offices.title AS tax_office', 'tax_recipients.title AS tax_recipient', 'personal_taxes.id')
            ->where('personal_taxes.id', $id)
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

        $columns = ['id', 'personal_card_id', 'tax_office_id', 'tax_recipient_id', ];

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
                $columns = implode(", ", ['id', 'title AS tax_office']);
                $result = TaxOffices::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS tax_recipient']);
                $result = TaxRecipients::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}