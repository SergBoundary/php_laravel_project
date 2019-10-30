<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MenusCreateRequest: Таблица настроек пользовательского меню системы
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class MenuCreateRequest extends FormRequest {

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
            'parent_id' => 'required|integer',
            'sort' => 'required|integer',
            'name' => 'required|string|max:100',
            'path' => 'string|max:50',
            'access_0' => 'required|boolean',
            'access_1' => 'required|boolean',
            'access_2' => 'required|boolean',
            'access_3' => 'required|boolean',
        ];
    }
}