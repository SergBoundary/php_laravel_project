<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccrualsUpdateRequest: Правила записи начислений
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class AccrualsUpdateRequest extends FormRequest {

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
            'accrual_type_id' => 'required|integer|exists:accrual_types,id',
            'amount' => 'required|numeric',
        ];
    }
}