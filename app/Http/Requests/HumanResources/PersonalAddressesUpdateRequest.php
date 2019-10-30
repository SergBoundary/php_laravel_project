<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalAddressesUpdateRequest: Правила записи адресов работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalAddressesUpdateRequest extends FormRequest {

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
            'postcode' => 'string|max:10',
            'city_id' => 'required|integer|exists:cities,id',
            'street' => 'required|string|max:50',
            'house' => 'required|string|max:10',
            'apartment' => 'string|max:10',
        ];
    }
}