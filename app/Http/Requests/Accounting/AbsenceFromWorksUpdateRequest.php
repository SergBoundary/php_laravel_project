<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AbsenceFromWorksUpdateRequest: Правила записи отсутствия на работе
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class AbsenceFromWorksUpdateRequest extends FormRequest {

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
            'absence_classifier_id' => 'required|integer|exists:absence_classifiers,id',
            'start' => 'required|date',
            'expiry' => 'date',
            'rationale' => 'required|string|max:20',
        ];
    }
}