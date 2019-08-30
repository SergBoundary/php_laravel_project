<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class AccrualTimesheetsUpdateRequest extends FormRequest
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
            'accrual_id' => 'required|integer|exists:accruals,id',
            'account_id' => 'required|integer|exists:accounts,id',
            'base_timesheet_id' => 'required|integer|exists:base_timesheets,id',
            'object_id' => 'required|integer|exists:objects,id',
            'days' => 'required|integer',
            'hours' => 'required|numeric',
            'month' => 'required|integer',
            'year' => 'required|integer',
        ];
    }
}
