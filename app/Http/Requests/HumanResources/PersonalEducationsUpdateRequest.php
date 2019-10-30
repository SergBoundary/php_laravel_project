<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalEducationsUpdateRequest: Правила записи образования и квалификации работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalEducationsUpdateRequest extends FormRequest {

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
            'education_type_id' => 'required|integer|exists:education_types,id',
            'study_mode_id' => 'required|integer|exists:study_modes,id',
            'institution' => 'required|string|max:100',
            'specialty' => 'required|string|max:100',
            'degree' => 'required|string|max:100',
            'degree_abbr' => 'required|string|max:10',
            'diploma' => 'required|string|max:100',
        ];
    }
}