<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class PersonalTaxesUpdateRequest extends FormRequest
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
            'tax_office_id' => 'required|integer|exists:tax_offices,id',
            'tax_recipient_id' => 'required|integer|exists:tax_recipients,id',
        ];
    }
}
