<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class BaseTimesheetsUpdateRequest extends FormRequest
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
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'accrual_id' => 'required|integer|exists:accruals,id',
            'day-1' => 'string|max:5',
            'day-2' => 'string|max:5',
            'day-3' => 'string|max:5',
            'day-4' => 'string|max:5',
            'day-5' => 'string|max:5',
            'day-6' => 'string|max:5',
            'day-7' => 'string|max:5',
            'day-8' => 'string|max:5',
            'day-9' => 'string|max:5',
            'day-10' => 'string|max:5',
            'day-11' => 'string|max:5',
            'day-12' => 'string|max:5',
            'day-13' => 'string|max:5',
            'day-14' => 'string|max:5',
            'day-15' => 'string|max:5',
            'day-16' => 'string|max:5',
            'day-17' => 'string|max:5',
            'day-18' => 'string|max:5',
            'day-19' => 'string|max:5',
            'day-20' => 'string|max:5',
            'day-21' => 'string|max:5',
            'day-22' => 'string|max:5',
            'day-23' => 'string|max:5',
            'day-24' => 'string|max:5',
            'day-25' => 'string|max:5',
            'day-26' => 'string|max:5',
            'day-27' => 'string|max:5',
            'day-28' => 'string|max:5',
            'day-29' => 'string|max:5',
            'day-30' => 'string|max:5',
            'day-31' => 'string|max:5',
            'hours_balance_classifier_id' => 'required|integer|exists:hours_balance_classifiers,id',
            'department_id' => 'required|integer|exists:departments,id',
            'amount' => 'required|numeric',
            'actual_days' => 'required|integer',
            'vacation_days' => 'required|integer',
            'childbirth_leave' => 'required|integer',
            'sick_days' => 'required|integer',
            'other_days' => 'required|integer',
            'unpaid_leave' => 'required|integer',
            'absense from work' => 'required|integer',
            'weekend' => 'required|integer',
            'holidays' => 'required|integer',
            'hours' => 'required|numeric',
            'night_hours' => 'required|numeric',
            'overtime' => 'required|numeric',
            'account_id' => 'required|integer|exists:accounts,id',
            'position_id' => 'required|integer|exists:positions,id',
            'object_id' => 'required|integer|exists:objects,id',
        ];
    }
}
