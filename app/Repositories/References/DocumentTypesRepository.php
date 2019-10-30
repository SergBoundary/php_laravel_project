<?php

namespace App\Repositories\References;

use App\Models\References\DocumentTypes as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class DocumentTypesRepository: Репозиторий списка видов кадровых документов
 *
 * @author SeBo
 *
 * @package App\Repositories\References
 */
class DocumentTypesRepository extends CoreRepository {

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
            ->select('document_types.title', 'document_types.abbr', 'document_types.standart_status', 'document_types.standart_number', 'document_types.id')
            ->orderBy('document_types.title')
            ->orderBy('document_types.abbr')
            ->orderBy('document_types.standart_status')
            ->orderBy('document_types.standart_number')
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
            ->select('document_types.title', 'document_types.abbr', 'document_types.standart_status', 'document_types.standart_number', 'document_types.template_form', 'document_types.template_view', 'document_types.template_print', 'document_types.id')
            ->where('document_types.id', $id)
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

        $columns = ['id', 'title', 'abbr', 'standart_status', 'standart_number', 'template_form', 'template_view', 'template_print', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}