<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CitiesCreateRequest: Правила записи списка населенных пунктов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class CitiesCreateRequest extends FormRequest {

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
            'region_id' => 'required|integer|exists:regions,id',
            'title' => 'required|string|max:100',
            'national_name' => 'string|max:100',
        ];
    }
}