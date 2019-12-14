<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalCardsUpdateRequest: Правила записи неизменяемых персональных данных
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalCardsUpdateRequest extends FormRequest {
	
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
//            'personal_account' => 'string|max:10',
//            'surname' => 'string|max:100',
//            'first_name' => 'string|max:100',
//            'second_name' => 'string|max:100',
//            'full_name_latina' => 'string|max:100',
//            'sex' => 'string|max:3',
//            'phone' => 'string|max:255',
//            'photo_url' => 'string|max:255',
        ];
    }
}