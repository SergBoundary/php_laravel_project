<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TeamsUpdateRequest: Правила записи списка бригад
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class TeamsUpdateRequest extends FormRequest {

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
            'title' => 'required|string|max:255',
            'abbr' => 'required|string|max:10',
        ];
    }
}