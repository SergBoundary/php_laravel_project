<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccrualsCreateRequest: Справочник. Классификатор начислений
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class AccrualsCreateRequest extends FormRequest {

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
            'accrual_group_id' => 'required|integer|exists:accrual_groups,id',
            'title' => 'required|string|max:10',
            'direction' => 'required|integer',
            'description' => 'required|string|max:50',
            'description_abbr' => 'required|string|max:10',
            'description_1c' => 'string|max:100',
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'accrual_sum' => 'required|numeric',
            'income_number_8dr' => 'required|integer',
            'calculation_number' => 'required|integer',
            'accrual_amount' => 'required|numeric',
            'accrual_analytics' => 'required|integer',
            'rounded amount' => 'required|integer',
            'rounded result' => 'required|integer',
            'account_title' => 'required|string|max:10',
        ];
    }
}