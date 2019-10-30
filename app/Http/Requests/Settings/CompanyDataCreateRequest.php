<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CompanyDataCreateRequest: Таблица реквизитов компании
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class CompanyDataCreateRequest extends FormRequest {

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
            'description' => 'required|string|max:255',
            'data_short' => 'required|string|max:100',
            'data_full' => 'required|string',
            'start' => 'required|date',
            'expiry' => 'required|date',
        ];
    }
}