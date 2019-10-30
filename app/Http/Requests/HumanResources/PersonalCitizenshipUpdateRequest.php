<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalCitizenshipUpdateRequest: Правила записи гражданств работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalCitizenshipUpdateRequest extends FormRequest {

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
            'country_id' => 'required|integer|exists:countries,id',
            'start' => 'required|date',
            'expiry' => 'required|date',
        ];
    }
}