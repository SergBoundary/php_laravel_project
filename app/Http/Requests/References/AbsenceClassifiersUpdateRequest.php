<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AbsenceClassifiersUpdateRequest: Справочник. Классификатор отсутствия на работе
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class AbsenceClassifiersUpdateRequest extends FormRequest {

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
            'accrual_id' => 'required|integer|exists:accruals,id',
            'absences_grouping_id' => 'required|integer|exists:grouping_types_of_absences,id',
            'title' => 'required|string|max:50',
            'abbr' => 'required|string|max:4',
        ];
    }
}