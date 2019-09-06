<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class MigrationStatusesUpdateRequest extends FormRequest
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
            'country_id' => 'required|integer|exists:countries,id',
            'status_old' => 'required|string|max:50',
            'status_new' => 'string|max:50',
            'opening_reason ' => 'string|max:100',
            'submitted' => 'date',
            'incomplete' => 'date',
            'decision_number' => 'string|max:50',
            'decision_date' => 'date',
            'date_opening' => 'date',
            'date_closing' => 'date',
            'closing_reason' => 'string|max:100',
        ];
    }
}
