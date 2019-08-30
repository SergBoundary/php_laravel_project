<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class VacationsCreateRequest extends FormRequest
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
            'document_id' => 'required|integer|exists:documents,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'absence_classifier_id' => 'required|integer|exists:absence_classifiers,id',
            'period_start' => 'required|date',
            'period_expiry' => 'required|date',
            'period' => 'required|integer',
            'start' => 'required|date',
            'expiry' => 'required|date',
            'phrase_list_id' => 'required|integer|exists:phrase_lists,id',
            'work_days' => 'required|integer',
            'work_hours' => 'required|integer',
            'vacation_pay' => 'required|numeric',
        ];
    }
}
