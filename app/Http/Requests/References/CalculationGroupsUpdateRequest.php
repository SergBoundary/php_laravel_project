<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CalculationGroupsUpdateRequest: Правила записи списка видов расчетов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class CalculationGroupsUpdateRequest extends FormRequest {

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
            'accrual_groups_id' => 'required|integer|exists:accrual_groups,id',
            'accrual_id' => 'required|integer|exists:accruals,id',
            'calculation_attribute' => 'required|integer',
        ];
    }
}