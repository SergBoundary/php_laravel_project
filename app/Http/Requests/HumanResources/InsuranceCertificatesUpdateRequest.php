<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceCertificatesUpdateRequest extends FormRequest
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
            'certificate_series' => 'required|string|max:10',
            'certificate_number' => 'required|string|max:50',
            'insurance_fee' => 'required|numeric',
            'certificate_expiry' => 'required|date',
        ];
    }
}
