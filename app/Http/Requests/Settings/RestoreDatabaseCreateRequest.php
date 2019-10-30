<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RestoreDatabaseCreateRequest: Таблица настроек восстановления базы данных
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class RestoreDatabaseCreateRequest extends FormRequest {

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
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'module' => 'required|string|max:50',
            'command' => 'required|string|max:50',
            'parametr' => 'required|string|max:50',
            'condition' => 'required|string|max:255',
        ];
    }
}