<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PhraseListGroupsUpdateRequest: Правила записи списка групп формулировок для заполнения документов и форм 
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PhraseListGroupsUpdateRequest extends FormRequest {

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
        ];
    }
}