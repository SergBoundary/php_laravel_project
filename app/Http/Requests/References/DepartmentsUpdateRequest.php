<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DepartmentsUpdateRequest: Правила записи списка подразделений компании
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class DepartmentsUpdateRequest extends FormRequest {

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
            'department_group_id' => 'required|integer|exists:department_groups,id',
            'title' => 'required|string|max:50',
            'abbr' => 'required|string|max:10',
            'department_attribute' => 'required|integer',
            'print_order' => 'required|integer',
        ];
    }
}