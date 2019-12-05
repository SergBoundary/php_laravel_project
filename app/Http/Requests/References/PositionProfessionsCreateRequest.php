<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PositionProfessionsCreateRequest: Справочник. Государственный классификатор профессий
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PositionProfessionsCreateRequest extends FormRequest {

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
            'code' => 'required|string|max:20',
            'title' => 'required|string|max:255',
        ];
    }
}