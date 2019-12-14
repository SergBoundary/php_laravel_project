<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Users as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class UsersRepository: Репозиторий учета пользователей системы
 *
 * @author SeBo
 *
 * @package App\Repositories\Settings
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
            ->select('users.name', 'users.personal_account', 'users.email', 'users.email_verified_at', 'users.password', 'users.access', 'users.id')
            ->orderBy('users.name')
            ->orderBy('users.personal_account')
            ->orderBy('users.email')
            ->orderBy('users.email_verified_at')
            ->orderBy('users.password')
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
            ->select('users.name', 'users.personal_account', 'users.email', 'users.email_verified_at', 'users.access', 'users.photo_url', 'users.created_at', 'users.id')
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

        $columns = ['id', 'name', 'personal_account', 'email', 'email_verified_at', 'password', 'access', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

}