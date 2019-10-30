<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class YearsUpdateRequest: Правила записи списка годов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class YearsUpdateRequest extends FormRequest {

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
        ];
    }
}