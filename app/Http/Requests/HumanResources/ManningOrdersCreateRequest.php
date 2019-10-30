<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManningOrdersCreateRequest: Правила записи должностных назначений
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class ManningOrdersCreateRequest extends FormRequest {

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
            'manning_table_id' => 'required|integer|exists:manning_tables,id',
            'assignment_date' => 'required|date',
            'assignment_order' => 'required|string|max:10',
            'resignation_date' => 'required|date',
            'resignation_order' => 'required|string|max:10',
            'salary' => 'required|numeric',
            'tariff' => 'required|numeric',
        ];
    }
}