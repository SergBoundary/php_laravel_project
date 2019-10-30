<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalCommunicationsCreateRequest: Правила записи способов коммуникации с работником
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalCommunicationsCreateRequest extends FormRequest {

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
            'communication_type_id' => 'required|integer|exists:communication_types,id',
            'content' => 'required|string|max:20',
        ];
    }
}