<?php

namespace App\Repositories\Settings;

use App\Models\Settings\CompanyData as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class CompanyDataRepository: Репозиторий реквизитов компании
 *
 * @author SeBo
 *
 * @package App\Repositories\Settings
 */
class CompanyDataRepository extends CoreRepository {

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
            ->select('company_data.title', 'company_data.data_short', 'company_data.start', 'company_data.expiry', 'company_data.id')
            ->orderBy('company_data.title')
            ->orderBy('company_data.data_short')
            ->orderBy('company_data.start')
            ->orderBy('company_data.expiry')
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
            ->select('company_data.title', 'company_data.description', 'company_data.data_short', 'company_data.data_full', 'company_data.start', 'company_data.expiry')
            ->where('company_data.id', $id)
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

        $columns = ['id', 'title', 'description', 'data_short', 'data_full', 'start', 'expiry', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}