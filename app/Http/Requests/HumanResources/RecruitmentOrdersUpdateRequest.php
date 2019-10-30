<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RecruitmentOrdersUpdateRequest: Правила записи найма и увольнений работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class RecruitmentOrdersUpdateRequest extends FormRequest {

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
            'document_id' => 'required|integer|exists:documents,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'employment_date' => 'required|date',
            'employment_order' => 'required|string|max:10',
            'probation' => 'required|integer',
            'dismissal_date' => 'required|date',
            'dismissal_order' => 'required|string|max:10',
            'dismissal_reason_id' => 'required|integer|exists:dismissal_reasons,id',
        ];
    }
}