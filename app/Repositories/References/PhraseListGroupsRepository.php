<?php

namespace App\Repositories\References;

use App\Models\References\PhraseListGroups as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PhraseListGroupsRepository: Репозиторий списка групп формулировок для заполнения документов и форм 
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class PhraseListGroupsRepository extends CoreRepository {

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
            ->select('phrase_list_groups.title', 'phrase_list_groups.id')
            ->orderBy('phrase_list_groups.title')
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
            ->select('phrase_list_groups.title', 'phrase_list_groups.id')
            ->where('phrase_list_groups.id', $id)
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

        $columns = ['id', 'title', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}