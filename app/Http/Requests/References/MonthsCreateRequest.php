<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class MonthsCreateRequest extends FormRequest
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
            'number' => 'required|integer',
            'title' => 'required|string|max:20',
        ];
    }
}