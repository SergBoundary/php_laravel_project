<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalCardsCreateRequest: Правила записи неизменяемых персональных данных
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalCardsCreateRequest extends FormRequest {

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
            //'personal_account' => 'required|string|max:10',
            //'tax_number' => 'string|max:15',
            //'surname' => 'required|string|max:100',
            //'first_name' => 'required|string|max:100',
            //'second_name' => 'string|max:100',
            //'full_name_latina' => 'string|max:100',
            //'sex' => 'string|max:3',
            //'photo_url' => 'string|max:255',
        ];
    }
}