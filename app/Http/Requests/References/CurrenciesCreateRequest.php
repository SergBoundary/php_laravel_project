<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class CurrenciesCreateRequest extends FormRequest
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
            'title' => 'required|string|max:30',
            'symbol' => 'required|string|max:3',
            'number' => 'required|string|max:3',
        ];
    }
}
