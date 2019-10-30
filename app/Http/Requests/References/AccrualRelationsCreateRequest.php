<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccrualRelationsCreateRequest: Правила записи списка зависимостей начислений
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class AccrualRelationsCreateRequest extends FormRequest {

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
            'accrual_id' => 'required|integer|exists:accruals,id',
            'relation_attribute' => 'required|integer',
        ];
    }
}