<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LogAccrualErrorsUpdateRequest: Таблица ошибок в расчете начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class LogAccrualErrorsUpdateRequest extends FormRequest {

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
            'message' => 'required|string|max:150',
            'error_type' => 'required|integer',
        ];
    }
}