<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RetentionsCreateRequest: Правила записи удержаний
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class RetentionsCreateRequest extends FormRequest {

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
            'retention_type_id' => 'required|integer|exists:retention_types,id',
            'amount' => 'required|numeric',
        ];
    }
}