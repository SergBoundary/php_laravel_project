<?php

namespace App\Http\Requests\Calculations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PaychecksCreateRequest: Таблица обслуживания расчетного листа по заработной плате
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PaychecksCreateRequest extends FormRequest {

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
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'balance_start' => 'required|numeric',
            'hourly' => 'required|numeric',
            'piecework' => 'required|numeric',
            'accrual' => 'required|numeric',
            'retention' => 'required|numeric',
            'issued_by' => 'required|numeric',
            'give_out' => 'required|numeric',
            'debt' => 'required|numeric',
        ];
    }
}