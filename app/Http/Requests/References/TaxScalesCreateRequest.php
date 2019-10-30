<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TaxScalesCreateRequest: Справочник. Шкала расчета подоходного налога
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class TaxScalesCreateRequest extends FormRequest {

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
            'title' => 'required|string|max:30',
            'lower amount' => 'numeric',
            'top amount' => 'numeric',
            'tax percentage' => 'required|numeric',
        ];
    }
}