<?php

namespace App\Repositories\References;

use App\Models\References\Teams as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class TeamsRepository: Репозиторий списка бригад
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class TeamsRepository extends CoreRepository {

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
            ->select('teams.title', 'teams.abbr', 'teams.id')
            ->orderBy('teams.title')
            ->orderBy('teams.abbr')
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
            ->select('teams.title', 'teams.abbr', 'teams.id')
            ->where('teams.id', $id)
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

        $columns = ['id', 'title', 'abbr', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}