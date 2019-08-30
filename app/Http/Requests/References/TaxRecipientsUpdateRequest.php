<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class TaxRecipientsUpdateRequest extends FormRequest
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
            'district_id' => 'required|integer|exists:districts,id',
            'region_id' => 'integer|exists:regions,id',
            'city_id' => 'integer|exists:cities,id',
            'title' => 'required|string|max:100',
        ];
    }
}
