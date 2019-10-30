<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TaxRateAmountsUpdateRequest: Справочник. Классификатор сумм оплаты налогов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class TaxRateAmountsUpdateRequest extends FormRequest {

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
            'tax_rate_id' => 'required|integer|exists:tax_rates,id',
            'date_from' => 'required|date',
            'amount_from' => 'required|numeric',
            'amount_to' => 'required|numeric',
            'amount' => 'required|numeric',
            'percent' => 'required|numeric',
        ];
    }
}