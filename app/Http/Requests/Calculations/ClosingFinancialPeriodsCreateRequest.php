<?php

namespace App\Http\Requests\Calculations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClosingFinancialPeriodsCreateRequest: Таблица обслуживания закрытия финансового периода
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class ClosingFinancialPeriodsCreateRequest extends FormRequest {

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