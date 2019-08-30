<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeAccrualsUpdateRequest extends FormRequest
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
            'department_id' => 'required|integer|exists:departments,id',
            'department_accrual_id' => 'required|integer|exists:department_accruals,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'accrual_amount' => 'required|numeric',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'days' => 'required|integer',
            'hours' => 'required|numeric',
            'team_id' => 'required|integer|exists:teams,id',
            'object_id' => 'required|integer|exists:objects,id',
            'account_title' => 'required|string|max:10',
            'currency_id' => 'required|integer',
            'currency_amount' => 'required|numeric',
            'currency_kurs_id' => 'required|integer|exists:currency_kurs,id',
            'tariff' => 'required|numeric',
            'calculation_year' => 'required|integer',
            'calculation_month' => 'required|integer',
            'comment' => 'required|string|max:50',
        ];
    }
}
