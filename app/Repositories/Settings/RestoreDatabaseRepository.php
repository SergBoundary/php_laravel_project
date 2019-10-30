<?php

namespace App\Repositories\Settings;

use App\Models\Settings\RestoreDatabase as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class RestoreDatabaseRepository: Репозиторий настроек восстановления базы данных
 *
 * @author SeBo
 *
 * @package App\Repositories\Settings
 */
class RestoreDatabaseRepository extends CoreRepository {

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
            ->select('restore_database.title', 'restore_database.module', 'restore_database.command', 'restore_database.parametr', 'restore_database.id')
            ->orderBy('restore_database.title')
            ->orderBy('restore_database.module')
            ->orderBy('restore_database.command')
            ->orderBy('restore_database.parametr')
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
            ->select('restore_database.title', 'restore_database.description', 'restore_database.module', 'restore_database.command', 'restore_database.parametr', 'restore_database.condition')
            ->where('restore_database.id', $id)
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

        $columns = ['id', 'title', 'description', 'module', 'command', 'parametr', 'condition', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}