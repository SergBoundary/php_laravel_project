<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalTaxesCreateRequest: Правила записи налоговой информации работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalTaxesCreateRequest extends FormRequest {

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
            'tax_office_id' => 'required|integer|exists:tax_offices,id',
            'tax_recipient_id' => 'required|integer|exists:tax_recipients,id',
        ];
    }
}