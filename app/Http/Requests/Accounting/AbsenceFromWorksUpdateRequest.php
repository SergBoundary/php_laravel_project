<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceFromWorksUpdateRequest extends FormRequest
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
            'absence_classifier_id' => 'required|integer|exists:absence_classifiers,id',
            'start' => 'required|date',
            'expiry' => 'date',
            'rationale' => 'required|string|max:20',
        ];
    }
}
