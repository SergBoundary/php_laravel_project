<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\FamilyRelationTypes;
use App\Models\HumanResources\EmployeeFamilies as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class EmployeeFamiliesRepository: Репозиторий учета влияния близкого окружения
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class EmployeeFamiliesRepository extends CoreRepository {

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
            ->join('personal_cards', 'employee_families.personal_card_id', '=', 'personal_cards.id')
            ->join('family_relation_types', 'employee_families.family_relation_type_id', '=', 'family_relation_types.id')
            ->select('personal_cards.personal_account AS personal_card', 'family_relation_types.title AS family_relation_type', 'employee_families.surname', 'employee_families.first_name', 'employee_families.born_date', 'employee_families.sex', 'employee_families.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('family_relation_types.title')
            ->orderBy('employee_families.surname')
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
            ->join('personal_cards', 'employee_families.personal_card_id', '=', 'personal_cards.id')
            ->join('family_relation_types', 'employee_families.family_relation_type_id', '=', 'family_relation_types.id')
            ->select('personal_cards.personal_account AS personal_card', 'family_relation_types.title AS family_relation_type', 'employee_families.surname', 'employee_families.first_name', 'employee_families.second_name', 'employee_families.born_date', 'employee_families.sex', 'employee_families.id')
            ->where('employee_families.id', $id)
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

        $columns = ['id', 'personal_card_id', 'family_relation_type_id', 'surname', 'first_name', 'second_name', 'born_date', 'sex', ];

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
                $columns = implode(", ", ['id', 'title AS family_relation_type']);
                $result = FamilyRelationTypes::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}