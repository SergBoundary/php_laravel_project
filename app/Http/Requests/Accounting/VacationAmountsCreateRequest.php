<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class VacationAmountsCreateRequest: Таблица расчета сумм отпускных
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class VacationAmountsCreateRequest extends FormRequest {

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
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'vacation_id' => 'required|integer|exists:vacations,id',
            'accrual_id' => 'required|integer|exists:accruals,id',
            'account_id' => 'required|integer|exists:accounts,id',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'calculation_year_id' => 'required|integer|exists:years,id',
            'calculation_month_id' => 'required|integer|exists:months,id',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'calculation_type' => 'required|integer',
            'days' => 'required|integer',
            'hours' => 'required|numeric',
            'days_unpaid' => 'required|integer',
            'days_paid' => 'required|integer',
            'days_total' => 'required|integer',
            'hours_total' => 'required|numeric',
            'amount_days' => 'required|numeric',
            'amount_hours' => 'required|numeric',
            'amount_total' => 'required|numeric',
            'percent' => 'required|numeric',
        ];
    }
}