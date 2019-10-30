<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class WorkOrdersAmountsUpdateRequest: Правила записи сумм нарядов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class WorkOrdersAmountsUpdateRequest extends FormRequest {

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
            'work_order_id' => 'required|integer|exists:work_orders,id',
            'piecework_id' => 'required|integer|exists:pieceworks,id',
            'account_id' => 'required|integer|exists:accounts,id',
            'object_id' => 'required|integer|exists:objects,id',
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'holidays_amount' => 'required|numeric',
            'hours' => 'required|numeric',
        ];
    }
}