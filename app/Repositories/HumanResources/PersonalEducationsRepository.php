<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\EducationTypes;
use App\Models\References\StudyModes;
use App\Models\HumanResources\PersonalEducations as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PersonalEducationsRepository: Репозиторий учета образования и квалификации работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class PersonalEducationsRepository extends CoreRepository {

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
            ->join('personal_cards', 'personal_educations.personal_card_id', '=', 'personal_cards.id')
            ->join('education_types', 'personal_educations.education_type_id', '=', 'education_types.id')
            ->join('study_modes', 'personal_educations.study_mode_id', '=', 'study_modes.id')
            ->select('personal_cards.personal_account AS personal_card', 'education_types.title AS education_type', 'study_modes.title AS study_mode', 'personal_educations.specialty', 'personal_educations.degree_abbr', 'personal_educations.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('education_types.title')
            ->orderBy('study_modes.title')
            ->orderBy('personal_educations.specialty')
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
            ->join('personal_cards', 'personal_educations.personal_card_id', '=', 'personal_cards.id')
            ->join('education_types', 'personal_educations.education_type_id', '=', 'education_types.id')
            ->join('study_modes', 'personal_educations.study_mode_id', '=', 'study_modes.id')
            ->select('personal_cards.personal_account AS personal_card', 'education_types.title AS education_type', 'study_modes.title AS study_mode', 'personal_educations.institution', 'personal_educations.specialty', 'personal_educations.degree', 'personal_educations.degree_abbr', 'personal_educations.diploma', 'personal_educations.id')
            ->where('personal_educations.id', $id)
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

        $columns = ['id', 'personal_card_id', 'education_type_id', 'study_mode_id', 'institution', 'specialty', 'degree', 'degree_abbr', 'diploma', ];

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
                $columns = implode(", ", ['id', 'title AS education_type']);
                $result = EducationTypes::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'title AS study_mode']);
                $result = StudyModes::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}