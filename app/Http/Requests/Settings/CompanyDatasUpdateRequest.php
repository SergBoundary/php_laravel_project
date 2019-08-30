<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class CompanyDatasUpdateRequest extends FormRequest
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
            'description' => 'required|string|max:255',
            'data_short' => 'required|string|max:100',
            'data_full' => 'required|string',
            'start' => 'required|date',
            'expiry' => 'required|date',
        ];
    }
}
