<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class HoursBalancesCreateRequest extends FormRequest
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
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'hours_balance_classifier_id' => 'required|integer|exists:hours_balance_classifiers,id',
            'balance_days' => 'required|integer',
            'balance_hours' => 'required|numeric',
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
            'evening-1' => 'string|max:5',
            'evening-2' => 'string|max:5',
            'evening-3' => 'string|max:5',
            'evening-4' => 'string|max:5',
            'evening-5' => 'string|max:5',
            'evening-6' => 'string|max:5',
            'evening-7' => 'string|max:5',
            'evening-8' => 'string|max:5',
            'evening-9' => 'string|max:5',
            'evening-10' => 'string|max:5',
            'evening-11' => 'string|max:5',
            'evening-12' => 'string|max:5',
            'evening-13' => 'string|max:5',
            'evening-14' => 'string|max:5',
            'evening-15' => 'string|max:5',
            'evening-16' => 'string|max:5',
            'evening-17' => 'string|max:5',
            'evening-18' => 'string|max:5',
            'evening-19' => 'string|max:5',
            'evening-20' => 'string|max:5',
            'evening-21' => 'string|max:5',
            'evening-22' => 'string|max:5',
            'evening-23' => 'string|max:5',
            'evening-24' => 'string|max:5',
            'evening-25' => 'string|max:5',
            'evening-26' => 'string|max:5',
            'evening-27' => 'string|max:5',
            'evening-28' => 'string|max:5',
            'evening-29' => 'string|max:5',
            'evening-30' => 'string|max:5',
            'evening-31' => 'string|max:5',
            'night-1' => 'string|max:5',
            'night-2' => 'string|max:5',
            'night-3' => 'string|max:5',
            'night-4' => 'string|max:5',
            'night-5' => 'string|max:5',
            'night-6' => 'string|max:5',
            'night-7' => 'string|max:5',
            'night-8' => 'string|max:5',
            'night-9' => 'string|max:5',
            'night-10' => 'string|max:5',
            'night-11' => 'string|max:5',
            'night-12' => 'string|max:5',
            'night-13' => 'string|max:5',
            'night-14' => 'string|max:5',
            'night-15' => 'string|max:5',
            'night-16' => 'string|max:5',
            'night-17' => 'string|max:5',
            'night-18' => 'string|max:5',
            'night-19' => 'string|max:5',
            'night-20' => 'string|max:5',
            'night-21' => 'string|max:5',
            'night-22' => 'string|max:5',
            'night-23' => 'string|max:5',
            'night-24' => 'string|max:5',
            'night-25' => 'string|max:5',
            'night-26' => 'string|max:5',
            'night-27' => 'string|max:5',
            'night-28' => 'string|max:5',
            'night-29' => 'string|max:5',
            'night-30' => 'string|max:5',
            'night-31' => 'string|max:5',
            'holiday-1' => 'string|max:5',
            'holiday-2' => 'string|max:5',
            'holiday-3' => 'string|max:5',
            'holiday-4' => 'string|max:5',
            'holiday-5' => 'string|max:5',
            'holiday-6' => 'string|max:5',
            'holiday-7' => 'string|max:5',
            'holiday-8' => 'string|max:5',
            'holiday-9' => 'string|max:5',
            'holiday-10' => 'string|max:5',
            'holiday-11' => 'string|max:5',
            'holiday-12' => 'string|max:5',
            'holiday-13' => 'string|max:5',
            'holiday-14' => 'string|max:5',
            'holiday-15' => 'string|max:5',
            'holiday-16' => 'string|max:5',
            'holiday-17' => 'string|max:5',
            'holiday-18' => 'string|max:5',
            'holiday-19' => 'string|max:5',
            'holiday-20' => 'string|max:5',
            'holiday-21' => 'string|max:5',
            'holiday-22' => 'string|max:5',
            'holiday-23' => 'string|max:5',
            'holiday-24' => 'string|max:5',
            'holiday-25' => 'string|max:5',
            'holiday-26' => 'string|max:5',
            'holiday-27' => 'string|max:5',
            'holiday-28' => 'string|max:5',
            'holiday-29' => 'string|max:5',
            'holiday-30' => 'string|max:5',
            'holiday-31' => 'string|max:5',
            'weekends' => 'required|integer',
            'holidays' => 'required|integer',
            'balance_evening' => 'required|numeric',
            'balance_night' => 'required|numeric',
        ];
    }
}