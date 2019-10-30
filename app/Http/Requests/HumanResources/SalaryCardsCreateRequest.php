<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SalaryCardsCreateRequest: Правила записи зарплатных карт работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class SalaryCardsCreateRequest extends FormRequest {

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
            'bank_id' => 'required|integer|exists:banks,id',
            'payment_card' => 'required|string|max:50',
            'expiry' => 'required|date',
        ];
    }
}