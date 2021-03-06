<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MonthsUpdateRequest: Правила записи списка месяцев
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class MonthsUpdateRequest extends FormRequest {

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
            'number' => 'required|integer',
            'title' => 'required|string|max:20',
        ];
    }
}