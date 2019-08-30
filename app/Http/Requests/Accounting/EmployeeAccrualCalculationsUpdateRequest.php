<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeAccrualCalculationsUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'accrual_id' => 'required|integer|exists:accruals,id',
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'tax_rate_id' => 'required|integer|exists:tax_rates,id',
            'object_id' => 'required|integer|exists:objects,id',
            'accrual_amount' => 'required|numeric',
            'start' => 'required|date',
            'expiry' => 'date',
            'save_of_analytics' => 'required|integer',
            'account_title' => 'required|string|max:10',
        ];
    }
}
