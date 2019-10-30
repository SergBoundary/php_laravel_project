<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ConstantsCreateRequest: Таблица констант системы
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class ConstantsCreateRequest extends FormRequest {

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
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:256',
            'value_number' => 'required|integer',
            'value_string' => 'required|string|max:255',
            'start' => 'required|date',
            'expiry' => 'required|date',
        ];
    }
}