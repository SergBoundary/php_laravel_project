<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EmployeeFamiliesCreateRequest: Правила записи влияния близкого окружения
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class EmployeeFamiliesCreateRequest extends FormRequest {

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
            'family_relation_type_id' => 'required|integer|exists:family_relation_types,id',
            'surname' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'second_name' => 'required|string|max:100',
            'born_date' => 'required|date',
            'sex' => 'required|integer',
        ];
    }
}