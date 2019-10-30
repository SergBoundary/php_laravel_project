<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EmployeeAccrualsUpdateRequest: Правила записи сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class EmployeeAccrualsUpdateRequest extends FormRequest {

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
            'department_id' => 'required|integer|exists:departments,id',
            'department_accrual_id' => 'required|integer|exists:department_accruals,id',
            'team_id' => 'required|integer|exists:teams,id',
            'object_id' => 'required|integer|exists:objects,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'days' => 'required|integer',
            'hours' => 'required|numeric',
            'accrual_amount' => 'required|numeric',
            'account_title' => 'required|string|max:10',
            'currency_id' => 'required|integer',
            'currency_amount' => 'required|numeric',
            'currency_kurs_id' => 'required|integer|exists:currency_kurses,id',
            'tariff' => 'required|numeric',
            'calculation_year' => 'required|integer',
            'calculation_month' => 'required|integer',
            'comment' => 'required|string|max:50',
        ];
    }
}