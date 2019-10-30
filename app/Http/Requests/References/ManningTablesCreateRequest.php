<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManningTablesCreateRequest: Справочник. Штатное расписание - список количеств, окладов и квалификации работников
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class ManningTablesCreateRequest extends FormRequest {

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
            'position_id' => 'required|integer|exists:positions,id',
            'rank_id' => 'required|integer|exists:ranks,id',
            'quantity' => 'required|integer',
            'salary' => 'required|numeric',
            'tariff' => 'required|numeric',
        ];
    }
}