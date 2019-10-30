<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class VacationsUpdateRequest: Правила записи отпусков
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class VacationsUpdateRequest extends FormRequest {

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
            'document_id' => 'required|integer|exists:documents,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'absence_classifier_id' => 'required|integer|exists:absence_classifiers,id',
            'period_start' => 'required|date',
            'period_expiry' => 'required|date',
            'period' => 'required|integer',
            'start' => 'required|date',
            'expiry' => 'required|date',
            'phrase_list_id' => 'required|integer|exists:phrase_lists,id',
            'work_days' => 'required|integer',
            'work_hours' => 'required|integer',
            'vacation_pay' => 'required|numeric',
        ];
    }
}