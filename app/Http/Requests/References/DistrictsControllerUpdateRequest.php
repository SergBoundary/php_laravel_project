<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class DistrictsControllerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return auth()->check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:3|max:50',
            'national_name' => 'string||min:3max:50',
            'number_iso' => 'string|min:2|max:8',
            'country_id' => 'required|integer|exists:countries,id', 
        ];
    }
}
