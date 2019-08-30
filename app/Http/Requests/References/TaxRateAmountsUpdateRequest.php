<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class TaxRateAmountsUpdateRequest extends FormRequest
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
            'tax_rate_id' => 'required|integer|exists:tax_rates,id',
            'date_from' => 'required|date',
            'amount_from' => 'required|numeric',
            'amount_to' => 'required|numeric',
            'amount' => 'required|numeric',
            'percent' => 'required|numeric',
        ];
    }
}
