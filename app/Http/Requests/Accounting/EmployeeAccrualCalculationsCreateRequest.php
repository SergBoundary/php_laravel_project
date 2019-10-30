<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EmployeeAccrualCalculationsCreateRequest: Таблица расчета сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class EmployeeAccrualCalculationsCreateRequest extends FormRequest {

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
            'object_id' => 'required|integer|exists:objects,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'accrual_id' => 'required|integer|exists:accruals,id',
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'tax_id' => 'required|integer|exists:tax_rates,id',
            'accrual_amount' => 'required|numeric',
            'start' => 'required|date',
            'expiry' => 'date',
            'save_of_analytics' => 'required|integer',
            'account_title' => 'required|string|max:10',
        ];
    }
}