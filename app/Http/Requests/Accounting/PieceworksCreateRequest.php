<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PieceworksCreateRequest: Правила записи сдельных работ
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PieceworksCreateRequest extends FormRequest {

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
//            'personal_card_id' => 'required|integer|exists:personal_cards,id',
//            'year_id' => 'required|integer|exists:years,id',
//            'month_id' => 'required|integer|exists:months,id',
//            'object_id' => 'required|integer|exists:objects,id',
//            'type' => 'required|string|max:50',
//            'unit' => 'required|string|max:50',
//            'quantity' => 'required|numeric',
//            'price' => 'required|numeric',
        ];
    }
}