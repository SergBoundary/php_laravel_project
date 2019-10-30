<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CurrenciesUpdateRequest: Правила записи списка валют
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class CurrenciesUpdateRequest extends FormRequest {

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
            'title' => 'required|string|max:30',
            'symbol' => 'required|string|max:3',
        ];
    }
}