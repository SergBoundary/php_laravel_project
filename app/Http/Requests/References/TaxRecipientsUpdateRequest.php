<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TaxRecipientsUpdateRequest: Правила записи списка получателей подоходного налога
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class TaxRecipientsUpdateRequest extends FormRequest {

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
            'region_id' => 'integer|exists:regions,id',
            'city_id' => 'integer|exists:cities,id',
            'title' => 'required|string|max:100',
        ];
    }
}