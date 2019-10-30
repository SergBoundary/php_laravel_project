<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProvisionsUpdateRequest: Правила записи материального обеспечения работника
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class ProvisionsUpdateRequest extends FormRequest {

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
            'manning_orders_id' => 'required|integer|exists:manning_orders,id',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'amount' => 'required|numeric',
            'rationale_title' => 'required|string|max:100',
            'provision_date' => 'required|date',
            'return_date' => 'required|date',
        ];
    }
}