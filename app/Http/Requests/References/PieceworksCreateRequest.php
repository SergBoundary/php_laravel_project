<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PieceworksCreateRequest: Правила записи списка сдельных работ
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PieceworksCreateRequest extends FormRequest {

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
            'pieceworks_unit_id' => 'required|integer|exists:pieceworks_units,id',
            'price' => 'required|numeric',
            'accrual_id' => 'required|integer|exists:accruals,id',
        ];
    }
}