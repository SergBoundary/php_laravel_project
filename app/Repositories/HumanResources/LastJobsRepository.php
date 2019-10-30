<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\PersonalCards;
use App\Models\References\PositionProfessions;
use App\Models\HumanResources\LastJobs as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class LastJobsRepository: Репозиторий учета предыдущих мест работы
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class LastJobsRepository extends CoreRepository {

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
            ->join('personal_cards', 'last_jobs.personal_card_id', '=', 'personal_cards.id')
            ->join('position_professions', 'last_jobs.position_profession_id', '=', 'position_professions.id')
            ->select('personal_cards.personal_account AS personal_card', 'position_professions.code AS position_profession', 'last_jobs.last_job', 'last_jobs.dismissal_date', 'last_jobs.id')
            ->orderBy('personal_cards.personal_account')
            ->orderBy('position_professions.code')
            ->orderBy('last_jobs.last_job')
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
            ->join('personal_cards', 'last_jobs.personal_card_id', '=', 'personal_cards.id')
            ->join('position_professions', 'last_jobs.position_profession_id', '=', 'position_professions.id')
            ->select('personal_cards.personal_account AS personal_card', 'position_professions.code AS position_profession', 'last_jobs.last_job', 'last_jobs.dismissal_date', 'last_jobs.dismissal_reason', 'last_jobs.id')
            ->where('last_jobs.id', $id)
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

        $columns = ['id', 'personal_card_id', 'last_job', 'position_profession_id', 'dismissal_date', 'dismissal_reason', ];

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