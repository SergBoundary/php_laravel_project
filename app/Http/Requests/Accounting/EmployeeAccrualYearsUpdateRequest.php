<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EmployeeAccrualYearsUpdateRequest: Правила записи сумм начислений работникам за год
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class EmployeeAccrualYearsUpdateRequest extends FormRequest {

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
            'calculation_year_id' => 'required|integer|exists:years,id',
            'calculation_month_id' => 'required|integer|exists:months,id',
            'department_id' => 'required|integer|exists:departments,id',
            'position_id' => 'required|integer|exists:positions,id',
            'object_id' => 'required|integer|exists:objects,id',
            'team_id' => 'required|integer|exists:teams,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'accrual_id' => 'required|integer|exists:accruals,id',
            'employment_type_id' => 'required|integer|exists:employment_types,id',
            'year_id' => 'required|integer|exists:years,id',
            'account_id' => 'required|integer|exists:accounts,id',
            'tax_scale_id' => 'required|integer|exists:tax_scales,id',
            'accrual_amount' => 'required|numeric',
            'retention_amount' => 'required|numeric',
            'days' => 'required|integer',
            'hours' => 'required|numeric',
            'analytics' => 'required|string|max:10',
            'currency_id' => 'required|integer|exists:currencies,id',
            'currency_amount' => 'required|numeric',
            'currency_kurs_id' => 'required|integer|exists:currency_kurses,id',
            'tariff' => 'required|numeric',
            'ssc_amount' => 'required|numeric',
            'ssc_amount_disability' => 'required|numeric',
            'ssc_amount_sickness' => 'required|numeric',
            'ssc_amount_disability_sickness' => 'required|numeric',
            'ssc_amount_civil_contract' => 'required|numeric',
            'retention_date' => 'required|date',
            'comment' => 'required|string|max:50',
        ];
    }
}