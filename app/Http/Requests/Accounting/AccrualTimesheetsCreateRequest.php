<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccrualTimesheetsCreateRequest: Таблица расчета сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class AccrualTimesheetsCreateRequest extends FormRequest {

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
            'account_id' => 'required|integer|exists:accounts,id',
            'base_timesheet_id' => 'required|integer|exists:base_timesheets,id',
            'object_id' => 'required|integer|exists:objects,id',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'days' => 'required|integer',
            'hours' => 'required|numeric',
        ];
    }
}