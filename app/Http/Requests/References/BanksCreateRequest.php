<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BanksCreateRequest: Правила записи списка банков
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class BanksCreateRequest extends FormRequest {

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
            'country_id' => 'required|integer|exists:countries,id',
            'title' => 'required|string|max:50',
            'commission' => 'numeric',
        ];
    }
}