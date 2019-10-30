<?php

namespace App\Http\Requests\Calculations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PayrollPreparationsUpdateRequest: Таблица обслуживания подготовки расчета заработной платы
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PayrollPreparationsUpdateRequest extends FormRequest {

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