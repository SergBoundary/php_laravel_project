<?php

namespace App\Http\Requests\Calculations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PayrollsCreateRequest: Таблица обслуживания расчета заработной платы
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PayrollsCreateRequest extends FormRequest {

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
            'accrual' => 'required|numeric',
            'retention' => 'required|numeric',
            'give_out' => 'required|numeric',
            'debt' => 'required|numeric',
        ];
    }
}