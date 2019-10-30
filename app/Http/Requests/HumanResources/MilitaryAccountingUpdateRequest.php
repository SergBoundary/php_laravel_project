<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MilitaryAccountingUpdateRequest: Таблица воинского учета работников
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class MilitaryAccountingUpdateRequest extends FormRequest {

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
            'accounting_group' => 'required|string|max:50',
            'accounting_category' => 'required|string|max:50',
            'composition' => 'required|string|max:50',
            'military_rank' => 'required|string|max:50',
            'military_specialty' => 'required|string|max:50',
            'military_suitability' => 'required|integer',
            'military_commissariat' => 'required|string|max:50',
        ];
    }
}