<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class VisaStatusesCreateRequest extends FormRequest
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
            'country_out_id' => 'required|integer|exists:countries,id',
            'country_in_id' => 'required|integer|exists:countries,id',
            'opening_reason ' => 'required|string|max:100',
            'submitted' => 'date',
            'incomplete' => 'date',
            'visa_issued' => 'date',
            'visa_type' => 'required|string|max:50',
            'date_opening' => 'required|date',
            'date_closing' => 'required|date',
            'closing_reason ' => 'string|max:100',
        ];
    }
}
