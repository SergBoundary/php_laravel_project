<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\PositionProfessions;
use App\Models\HumanResources\WorkExperiences as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class WorkExperiencesRepository: Репозиторий учета трудового стаража работника
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class WorkExperiencesRepository extends CoreRepository {

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
            ->join('personal_cards', 'work_experiences.personal_card_id', '=', 'personal_cards.id')
            ->join('position_professions', 'work_experiences.position_profession_id', '=', 'position_professions.id')
            ->select('personal_cards.personal_account AS personal_card', 'position_professions.code AS position_profession', 'work_experiences.work_experience_years', 'work_experiences.work_experience_months', 'work_experiences.work_experience_days', 'work_experiences.work_experience_continuous', 'work_experiences.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('position_professions.code')
            ->orderBy('work_experiences.work_experience_years')
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
            ->join('personal_cards', 'work_experiences.personal_card_id', '=', 'personal_cards.id')
            ->join('position_professions', 'work_experiences.position_profession_id', '=', 'position_professions.id')
            ->select('personal_cards.personal_account AS personal_card', 'position_professions.code AS position_profession', 'work_experiences.work_experience_years', 'work_experiences.work_experience_months', 'work_experiences.work_experience_days', 'work_experiences.work_experience_continuous', 'work_experiences.id')
            ->where('work_experiences.id', $id)
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

        $columns = ['id', 'personal_card_id', 'position_profession_id', 'work_experience_years', 'work_experience_months', 'work_experience_days', 'work_experience_continuous', ];

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
                $columns = implode(", ", ['id', 'CONCAT(code, ", ", title) AS position_profession']);
                $result = PositionProfessions::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}