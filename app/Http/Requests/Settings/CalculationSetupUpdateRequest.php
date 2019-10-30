<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CalculationSetupUpdateRequest: Таблица настроек финансовых параметров расчетов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class CalculationSetupUpdateRequest extends FormRequest {

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
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'value' => 'required|numeric',
            'start' => 'required|date',
            'expiry' => 'required|date',
        ];
    }
}