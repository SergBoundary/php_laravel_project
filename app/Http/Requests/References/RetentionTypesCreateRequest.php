<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RetentionTypesCreateRequest: Правила записи списка видов удержаний
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class RetentionTypesCreateRequest extends FormRequest {

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
            'title' => 'required|string|max:5',
            'description' => 'required|string|max:100',
            'abbr' => 'required|string|max:20',
        ];
    }
}