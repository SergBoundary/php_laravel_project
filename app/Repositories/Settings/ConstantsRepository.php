<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Constants as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class ConstantsRepository: Репозиторий констант системы
 *
 * @author SeBo
 *
 * @package App\Repositories\Settings
 */
class ConstantsRepository extends CoreRepository {

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
            ->select('constants.title', 'constants.value_number', 'constants.value_string', 'constants.start', 'constants.expiry', 'constants.id')
            ->orderBy('constants.title')
            ->orderBy('constants.value_number')
            ->orderBy('constants.value_string')
            ->orderBy('constants.start')
            ->orderBy('constants.expiry')
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
            ->select('constants.title', 'constants.description', 'constants.value_number', 'constants.value_string', 'constants.start', 'constants.expiry', 'constants.id')
            ->where('constants.id', $id)
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

        $columns = ['id', 'title', 'description', 'value_number', 'value_string', 'start', 'expiry' ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}