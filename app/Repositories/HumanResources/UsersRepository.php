<?php

namespace App\Repositories\HumanResources;

use App\Models\HumanResources\Users as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class UsersRepository: Репозиторий учета пользователей системы
 *
 * @author SeBo
 *
 * @package App\Repositories\HumanResources
 */
class UsersRepository extends CoreRepository {

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
            ->select('users.name', 'users.email', 'users.email_verified_at', 'users.access', 'users.id')
            ->orderBy('users.name')
            ->orderBy('users.email')
            ->orderBy('users.email_verified_at')
            ->orderBy('users.access')
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
            ->select('users.name', 'users.email', 'users.email_verified_at', 'users.password', 'users.access', 'users.id')
            ->where('users.id', $id)
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

        $columns = ['id', 'name', 'email', 'email_verified_at', 'password', 'access', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}