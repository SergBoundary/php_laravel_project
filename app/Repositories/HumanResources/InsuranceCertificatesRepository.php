<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\InsuranceCertificates as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class InsuranceCertificatesRepository: Репозиторий учета страховых свидетельств работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class InsuranceCertificatesRepository extends CoreRepository {

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
            ->join('personal_cards', 'insurance_certificates.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'insurance_certificates.certificate_series', 'insurance_certificates.certificate_number', 'insurance_certificates.insurance_fee', 'insurance_certificates.certificate_expiry', 'insurance_certificates.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('insurance_certificates.certificate_series')
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
            ->join('personal_cards', 'insurance_certificates.personal_card_id', '=', 'personal_cards.id')
            ->select('personal_cards.personal_account AS personal_card', 'insurance_certificates.certificate_series', 'insurance_certificates.certificate_number', 'insurance_certificates.insurance_fee', 'insurance_certificates.certificate_expiry', 'insurance_certificates.id')
            ->where('insurance_certificates.id', $id)
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

        $columns = ['id', 'personal_card_id', 'certificate_series', 'certificate_number', 'insurance_fee', 'certificate_expiry', ];

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