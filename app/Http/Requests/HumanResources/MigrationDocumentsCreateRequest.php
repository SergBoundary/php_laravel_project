<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MigrationDocumentsCreateRequest: Правила записи документов работника для легализации пребывания в стране
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class MigrationDocumentsCreateRequest extends FormRequest {

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
            'migration_status_id' => 'required|integer|exists:migration_statuses,id',
            'type' => 'required|string|max:50',
            'number' => 'string|max:20',
            'date_issued' => 'required|date',
            'date_expiration' => 'date',
            'date_inclusion' => 'required|date',
            'date_seizure' => 'date',
        ];
    }
}