<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class ConstantsUpdateRequest extends FormRequest
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
            'description' => 'required|string|max:256',
            'value_number' => 'required|integer',
            'value_string' => 'required|string|max:255',
            'start' => 'required|date',
            'expiry' => 'required|date',
        ];
    }
}
