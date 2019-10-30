<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DocumentTypesCreateRequest: Правила записи списка видов кадровых документов
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class DocumentTypesCreateRequest extends FormRequest {

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
            'title' => 'required|string|max:80',
            'abbr' => 'required|string|max:10',
            'standart_status' => 'required|boolean',
            'standart_number' => 'required|string|max:10',
            'template_form' => 'required|string|max:50',
            'template_view' => 'required|string|max:100',
            'template_print' => 'required|string|max:100',
        ];
    }
}