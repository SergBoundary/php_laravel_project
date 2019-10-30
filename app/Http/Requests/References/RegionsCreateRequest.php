<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegionsCreateRequest: Правила записи списка районов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class RegionsCreateRequest extends FormRequest {

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
            'district_id' => 'required|integer|exists:districts,id',
            'title' => 'required|string|max:50',
            'national_name' => 'string|max:50',
        ];
    }
}