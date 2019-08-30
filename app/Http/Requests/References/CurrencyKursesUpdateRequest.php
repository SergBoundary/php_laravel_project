<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyKursesUpdateRequest extends FormRequest
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
            'base currency_id' => 'required|integer|exists:currencies,id',
            'quoted currency_id' => 'required|integer|exists:currencies,id',
            'residual' => 'required|numeric',
            'bay' => 'required|numeric',
            'sell' => 'required|numeric',
        ];
    }
}
