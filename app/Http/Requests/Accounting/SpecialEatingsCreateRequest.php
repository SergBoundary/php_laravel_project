<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class SpecialEatingsCreateRequest extends FormRequest
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
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'year_id' => 'required|integer|exists:years,id',
            'month_id' => 'required|integer|exists:months,id',
            'residual_amount' => 'required|numeric',
            'amount' => 'required|numeric',
            'hours' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'unit_quantity' => 'required|integer',
        ];
    }
}
