<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DepartmentAccrualsUpdateRequest: Правила записи сумм начисления по подразделению
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class DepartmentAccrualsUpdateRequest extends FormRequest {

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
            'department_id' => 'required|integer|exists:departments,id',
            'team_id' => 'required|integer|exists:teams,id',
            'object_id' => 'required|integer|exists:objects,id',
            'accrual_amount' => 'required|numeric',
            'accrual_date' => 'required|date',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'loaded' => 'required|integer',
        ];
    }
}