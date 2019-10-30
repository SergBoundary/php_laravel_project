<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CurrencyKursesCreateRequest: Правила записи списка текущих курсов валют
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class CurrencyKursesCreateRequest extends FormRequest {

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
            'base currency_id' => 'required|integer|exists:currencies,id',
            'quoted currency_id' => 'required|integer|exists:currencies,id',
            'scale' => 'required|string|max:10',
            'residual' => 'required|numeric',
            'bay' => 'required|numeric',
            'sell' => 'required|numeric',
        ];
    }
}