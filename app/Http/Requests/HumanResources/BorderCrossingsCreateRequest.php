<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BorderCrossingsCreateRequest: Правила записи пересечения границы страны пребывания работником
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class BorderCrossingsCreateRequest extends FormRequest {

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
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'country_out_id' => 'required|integer|exists:countries,id',
            'country_in_id' => 'required|integer|exists:countries,id',
            'date' => 'required|date',
            'comment' => 'string|max:50',
        ];
    }
}