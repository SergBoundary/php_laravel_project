<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class WorkExperiencesCreateRequest: Правила записи трудового стаража работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class WorkExperiencesCreateRequest extends FormRequest {

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
            'position_profession_id' => 'required|integer|exists:position_professions,id',
            'work_experience_years' => 'required|integer',
            'work_experience_months' => 'required|integer',
            'work_experience_days' => 'required|integer',
            'work_experience_continuous' => 'required|integer',
        ];
    }
}