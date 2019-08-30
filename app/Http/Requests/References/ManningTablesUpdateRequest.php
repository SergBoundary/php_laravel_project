<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class ManningTablesUpdateRequest extends FormRequest
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
            'department_id' => 'required|integer|exists:departments,id',
            'position_id' => 'required|integer|exists:positions,id',
            'rank_id' => 'required|integer|exists:ranks,id',
            'quantity' => 'required|integer',
            'salary' => 'required|numeric',
            'tariff' => 'required|numeric',
        ];
    }
}
