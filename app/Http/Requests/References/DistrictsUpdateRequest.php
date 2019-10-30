<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DistrictsUpdateRequest: Правила записи списка областей (штатов, земель, воевудств)
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class DistrictsUpdateRequest extends FormRequest {

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
            'title' => 'required|string|max:50',
            'national_name' => 'string|max:50',
            'number_iso' => 'string|max:8',
        ];
    }
}