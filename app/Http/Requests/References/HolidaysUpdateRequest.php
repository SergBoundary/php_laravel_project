<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HolidaysUpdateRequest: Правила записи списка праздничных дней
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class HolidaysUpdateRequest extends FormRequest {

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
            'country_id' => 'required|integer|exists:countries,id',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'holiday' => 'required|integer',
            'title' => 'required|string|max:50',
            'not_work' => 'required|boolean',
            'religion' => 'required|boolean',
        ];
    }
}