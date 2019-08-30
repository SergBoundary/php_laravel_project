<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentOrdersUpdateRequest extends FormRequest
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
            'document_id' => 'required|integer|exists:personal_cards,id',
            'personal_card_id' => 'required|integer|exists:dismissal_reasons,id',
            'employment_date' => 'required|date',
            'employment_order' => 'required|string|max:10',
            'probation' => 'required|integer',
            'dismissal_date' => 'required|date',
            'dismissal_order' => 'required|string|max:10',
            'dismissal_reason_id' => 'required|integer|exists:documents,id',
        ];
    }
}
