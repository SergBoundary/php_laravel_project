<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class WorkOrdersCreateRequest: Правила записи нарядов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class WorkOrdersCreateRequest extends FormRequest {

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
            'department_id' => 'required|integer|exists:departments,id',
            'object_id' => 'required|integer|exists:objects,id',
            'team_id' => 'required|integer|exists:teams,id',
            'account_id' => 'required|integer|exists:accounts,id',
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'date' => 'required|date',
            'number' => 'required|string|max:50',
            'amount' => 'required|numeric',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
        ];
    }
}