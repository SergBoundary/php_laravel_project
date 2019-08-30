<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class WorkExperiencesCreateRequest extends FormRequest
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
            'position_profession_id' => 'required|integer|exists:position_professions,id',
            'work_experience_years' => 'required|integer',
            'work_experience_months' => 'required|integer',
            'work_experience_days' => 'required|integer',
            'work_experience_continuous' => 'required|integer',
        ];
    }
}
