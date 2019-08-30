<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class CountriesUpdateRequest extends FormRequest
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
            'national_name' => 'string|max:50',
            'symbol_alfa2 ' => 'string|max:2',
            'symbol_alfa3' => 'string|max:3',
            'number_iso' => 'string|max:3',
            'visible' => 'required|boolean',
        ];
    }
}
