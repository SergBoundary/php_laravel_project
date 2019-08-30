<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeAccrualChangesCreateRequest extends FormRequest
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
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'tax_rates_id' => 'required|integer|exists:tax_rates,id',
            'date_to' => 'required|date',
            'amount' => 'required|numeric',
        ];
    }
}
