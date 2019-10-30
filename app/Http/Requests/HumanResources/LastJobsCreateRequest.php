<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LastJobsCreateRequest: Правила записи предыдущих мест работы
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class LastJobsCreateRequest extends FormRequest {

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
            'last_job' => 'required|string|max:100',
            'position_profession_id' => 'required|integer|exists:position_professions,id',
            'dismissal_date' => 'required|date',
            'dismissal_reason' => 'required|string|max:100',
        ];
    }
}