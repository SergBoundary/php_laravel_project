<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalPasportsCreateRequest: Правила записи паспортов работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalPasportsCreateRequest extends FormRequest {

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
            'series' => 'required|string|max:10',
            'number' => 'required|string|max:10',
            'issuing_date' => 'required|date',
            'issuing_authority' => 'required|string|max:30',
            'expiration date' => 'required|date',
        ];
    }
}