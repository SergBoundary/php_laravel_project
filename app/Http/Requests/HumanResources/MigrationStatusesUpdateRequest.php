<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MigrationStatusesUpdateRequest: Правила записи миграционного статуса работника в стране
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class MigrationStatusesUpdateRequest extends FormRequest {

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
            'status_old' => 'required|string|max:50',
            'status_new' => 'string|max:50',
            'opening_reason' => 'string|max:100',
            'submitted' => 'date',
            'incomplete' => 'date',
            'decision_number' => 'string|max:50',
            'decision_date' => 'date',
            'date_opening' => 'date',
            'date_closing' => 'date',
            'closing_reason' => 'string|max:100',
        ];
    }
}