<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CountriesUpdateRequest: Правила записи списка стран
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class CountriesUpdateRequest extends FormRequest {

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
            'national_name' => 'string|max:50',
            'symbol_alfa2' => 'string|max:2',
            'symbol_alfa3' => 'string|max:3',
            'number_iso' => 'string|max:3',
            'visible' => 'required|boolean',
        ];
    }
}