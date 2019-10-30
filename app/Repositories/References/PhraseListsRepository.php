<?php

namespace App\Repositories\References;

use App\Models\References\PhraseListGroups;
use App\Models\References\PhraseLists as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class PhraseListsRepository: Репозиторий списка формулировок для заполнения документов и форм 
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class PhraseListsRepository extends CoreRepository {

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
            ->join('phrase_list_groups', 'phrase_lists.phrase_group_id', '=', 'phrase_list_groups.id')
            ->select('phrase_list_groups.title AS phrase_group', 'phrase_lists.title', 'phrase_lists.id')
            ->orderBy('phrase_list_groups.title')
            ->orderBy('phrase_lists.title')
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
            ->join('phrase_list_groups', 'phrase_lists.phrase_group_id', '=', 'phrase_list_groups.id')
            ->select('phrase_list_groups.title AS phrase_group', 'phrase_lists.title', 'phrase_lists.id')
            ->where('phrase_lists.id', $id)
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

        $columns = ['id', 'phrase_group_id', 'title', ];

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
                $columns = implode(", ", ['id', 'title AS phrase_group']);
                $result = PhraseListGroups::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}