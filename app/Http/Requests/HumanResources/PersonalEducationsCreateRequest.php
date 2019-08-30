<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class PersonalEducationsCreateRequest extends FormRequest
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
            'education_type_id' => 'required|integer|exists:education_types,id',
            'study_mode_id' => 'required|integer|exists:study_modes,id',
            'institution' => 'required|string|max:100',
            'specialty' => 'required|string|max:100',
            'degree' => 'required|string|max:100',
            'diploma' => 'required|string|max:100',
        ];
    }
}
