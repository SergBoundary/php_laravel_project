<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class InsuranceCertificatesUpdateRequest: Правила записи страховых свидетельств работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class InsuranceCertificatesUpdateRequest extends FormRequest {

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
            'certificate_series' => 'required|string|max:10',
            'certificate_number' => 'required|string|max:50',
            'insurance_fee' => 'required|numeric',
            'certificate_expiry' => 'required|date',
        ];
    }
}