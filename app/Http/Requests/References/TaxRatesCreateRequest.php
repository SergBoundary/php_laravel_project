<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TaxRatesCreateRequest: Справочник. Классификатор налоговых ставок
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class TaxRatesCreateRequest extends FormRequest {

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
            'title' => 'required|string|max:50',
        ];
    }
}