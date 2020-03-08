<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TeamsUpdateRequest: Правила записи формирования бригад
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class TeamsUpdateRequest extends FormRequest {

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
//            'personal_card_id' => 'required|integer|exists:personal_cards,id',
//            'title' => 'required|string|max:255',
//            'abbr' => 'required|string|max:10',
        ];
    }
}