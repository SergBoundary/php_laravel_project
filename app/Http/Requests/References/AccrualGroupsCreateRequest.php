<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class AccrualGroupsCreateRequest extends FormRequest
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
            'type' => 'required|integer',
        ];
    }
}
