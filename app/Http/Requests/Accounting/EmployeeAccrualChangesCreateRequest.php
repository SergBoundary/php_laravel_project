<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EmployeeAccrualChangesCreateRequest: Правила записи переформирования начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class EmployeeAccrualChangesCreateRequest extends FormRequest {

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
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'tax_rates_id' => 'required|integer|exists:tax_rates,id',
            'date_to' => 'required|date',
            'amount' => 'required|numeric',
        ];
    }
}