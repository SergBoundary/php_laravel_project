<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SpecialEatingsCreateRequest: Правила записи специального питания
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class SpecialEatingsCreateRequest extends FormRequest {

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
            'residual_amount' => 'required|numeric',
            'amount' => 'required|numeric',
            'hours' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'unit_quantity' => 'required|integer',
        ];
    }
}