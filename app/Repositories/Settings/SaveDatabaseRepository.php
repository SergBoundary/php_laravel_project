<?php

namespace App\Repositories\Settings;

use App\Models\Settings\SaveDatabase as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class SaveDatabaseRepository: Репозиторий настроек сохранения базы данных
 *
 * @author SeBo
 *
 * @package App\Repositories\Settings
 */
class SaveDatabaseRepository extends CoreRepository {

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
            ->select('save_database.title', 'save_database.module', 'save_database.command', 'save_database.month_day', 'save_database.week_day', 'save_database.run_time', 'save_database.id')
            ->orderBy('save_database.title')
            ->orderBy('save_database.module')
            ->orderBy('save_database.command')
            ->orderBy('save_database.month_day')
            ->orderBy('save_database.week_day')
            ->orderBy('save_database.run_time')
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
            ->select('save_database.title', 'save_database.description', 'save_database.module', 'save_database.command', 'save_database.parametr', 'save_database.start', 'save_database.expiry', 'save_database.month_day', 'save_database.week_day', 'save_database.run_time', 'save_database.condition')
            ->where('save_database.id', $id)
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

        $columns = ['id', 'title', 'description', 'module', 'command', 'parametr', 'start', 'expiry', 'month_day', 'week_day', 'run_time', 'condition', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}