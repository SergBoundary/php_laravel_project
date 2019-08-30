<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class LastJobsCreateRequest extends FormRequest
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
            'last_job' => 'required|string|max:100',
            'position_profession_id' => 'required|integer|exists:position_professions,id',
            'dismissal_date' => 'required|date',
            'dismissal_reason' => 'required|string|max:100',
        ];
    }
}
