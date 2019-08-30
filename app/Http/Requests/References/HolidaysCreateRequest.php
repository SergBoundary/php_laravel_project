<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class HolidaysCreateRequest extends FormRequest
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
            'country_id' => 'required|integer|exists:countries,id',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'holiday' => 'required|integer',
            'not_work' => 'required|boolean',
            'religion' => 'required|boolean',
        ];
    }
}
