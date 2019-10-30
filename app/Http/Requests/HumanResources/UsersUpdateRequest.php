<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UsersUpdateRequest: Правила записи пользователей системы
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class UsersUpdateRequest extends FormRequest {

    /**
     * Создает реквест, если пользователь авторизован.
     *
     * @return bool
     */
    public function authorize() {
        return auth()->check();
    }

    /**
     * Получает правила проверки данных для реквеста.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|string',
            'email' => 'required|string',
            'email_verified_at' => 'date',
            'password' => 'required|string',
            'access' => 'required|boolean',
        ];
    }
}