<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManningOrdersUpdateRequest: Правила записи должностных назначений
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class ManningOrdersUpdateRequest extends FormRequest {

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
//            'personal_card_id' => 'required|integer|exists:personal_cards,id',
//            'department_id' => 'required|integer|exists:departments,id',
//            'position_id' => 'required|integer|exists:positions,id',
//            'position_profession_id' => 'required|integer|exists:position_professions,id',
//            'assignment_date' => 'required',
        ];
    }
}