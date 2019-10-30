<?php

namespace App\Repositories\HumanResources;

use App\Models\References\Nationalities;
use App\Models\References\Cities;
use App\Models\References\Regions;
use App\Models\References\Districts;
use App\Models\References\Countries;
use App\Models\References\MaritalStatuses;
use App\Models\References\ClothingSizes;
use App\Models\References\ShoeSizes;
use App\Models\References\Disabilities;
use App\Models\HumanResources\PersonalCards as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

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

        $result = $this->startConditions()
            ->select('personal_cards.personal_account', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.born_date', 'personal_cards.id')
            ->orderBy('personal_cards.surname')
            ->orderBy('personal_cards.first_name')
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
            ->join('nationalities', 'personal_cards.nationality_id', '=', 'nationalities.id')
            ->join('cities', 'personal_cards.born_city_id', '=', 'cities.id')
            ->join('regions', 'personal_cards.born_region_id', '=', 'regions.id')
            ->join('districts', 'personal_cards.born_district_id', '=', 'districts.id')
            ->join('countries', 'personal_cards.born_country_id', '=', 'countries.id')
            ->join('marital_statuses', 'personal_cards.marital_status_id', '=', 'marital_statuses.id')
            ->join('clothing_sizes', 'personal_cards.clothing_size_id', '=', 'clothing_sizes.id')
            ->join('shoe_sizes', 'personal_cards.shoe_size_id', '=', 'shoe_sizes.id')
            ->join('disabilities', 'personal_cards.disability_id', '=', 'disabilities.id')
            ->select('nationalities.title AS nationality', 'cities.title AS born_city', 'regions.title AS born_region', 'districts.title AS born_district', 'countries.title AS born_country', 'marital_statuses.title AS marital_status', 'clothing_sizes.title AS clothing_size', 'shoe_sizes.title AS shoe_size', 'disabilities.title AS disability', 'personal_cards.tax_number', 'personal_cards.surname', 'personal_cards.first_name', 'personal_cards.second_name', 'personal_cards.nationality_id', 'personal_cards.born_date', 'personal_cards.sex', 'personal_cards.union_member', 'personal_cards.disability', 'personal_cards.pension_date', 'personal_cards.pension_certificate', 'personal_cards.photo_url', 'personal_cards.id')
            ->where('personal_cards.id', $id)
            ->toBase()
            ->first();
//dd($result);
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

        $columns = ['id', 'personal_account', 'tax_number', 'surname', 'first_name', 'second_name', 'full_name_latina', 'nationality_id', 'born_date', 'born_city_id', 'born_region_id', 'born_district_id', 'born_country_id', 'sex', 'marital_status_id', 'clothing_size_id', 'shoe_size_id', 'union_member', 'disability', 'disability_id', 'pension_date', 'pension_certificate', 'photo_url', ];

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
                $columns = implode(", ", ['id', 'title AS nationality']);
                $result = Nationalities::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'title AS born_city']);
                $result = Cities::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS born_region']);
                $result = Regions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", number_iso) AS born_district']);
                $result = Districts::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS born_country']);
                $result = Countries::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'title AS marital_status']);
                $result = MaritalStatuses::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 6:
                $columns = implode(", ", ['id', 'title AS clothing_size']);
                $result = ClothingSizes::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 7:
                $columns = implode(", ", ['id', 'title AS shoe_size']);
                $result = ShoeSizes::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 8:
                $columns = implode(", ", ['id', 'title AS disability']);
                $result = Disabilities::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}