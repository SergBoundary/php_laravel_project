<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccrualGroupsCreateRequest: Правила записи списка групп видов начислений
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class AccrualGroupsCreateRequest extends FormRequest {

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
            'description' => 'required|string|max:256',
            'type' => 'required|integer',
        ];
    }
}