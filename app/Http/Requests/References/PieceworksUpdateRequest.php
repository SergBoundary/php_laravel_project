<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class PieceworksUpdateRequest extends FormRequest
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
            'piecework_unit_id' => 'required|integer|exists:piecework_units,id',
            'price' => 'required|numeric',
            'accrual_id' => 'required|integer|exists:accruals,id',
        ];
    }
}
