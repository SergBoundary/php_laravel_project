<?php

namespace App\Http\Requests\Calculations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PayrollsUpdateRequest: Таблица обслуживания расчета заработной платы
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PayrollsUpdateRequest extends FormRequest {

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
        ];
    }
}