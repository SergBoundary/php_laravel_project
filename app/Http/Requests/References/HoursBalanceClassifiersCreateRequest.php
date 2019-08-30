<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class HoursBalanceClassifiersCreateRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'monday_day' => 'string|max:5',
            'tuesday_day' => 'string|max:5',
            'wednesday_day' => 'string|max:5',
            'thursday_day' => 'string|max:5',
            'friday_day' => 'string|max:5',
            'saturday_day' => 'string|max:5',
            'sunday_day' => 'string|max:5',
            'hours_reduction' => 'string|max:5',
            'hourly_rate' => 'required|numeric',
            'period' => 'required|integer',
            'monday_evening' => 'string|max:5',
            'tuesday_evening' => 'string|max:5',
            'wednesday_evening' => 'string|max:5',
            'thursday_evening' => 'string|max:5',
            'friday_evening' => 'string|max:5',
            'saturday_evening' => 'string|max:5',
            'sunday_evening' => 'string|max:5',
            'monday_night' => 'string|max:5',
            'tuesday_night' => 'string|max:5',
            'wednesday_night' => 'string|max:5',
            'thursday_night' => 'string|max:5',
            'friday_night' => 'string|max:5',
            'saturday_night' => 'string|max:5',
            'sunday_night' => 'string|max:5',
        ];
    }
}
