<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class VisaDocumentsCreateRequest extends FormRequest
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
            'visa_status_id' => 'required|integer|exists:visa_statuses,id',
            'type' => 'required|string|max:50',
            'number' => 'string|max:20',
            'date_issued' => 'required|date',
            'date_expiration' => 'date',
            'date_inclusion' => 'required|date',
            'date_seizure' => 'date',
        ];
    }
}
