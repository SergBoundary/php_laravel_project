<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeFamiliesCreateRequest extends FormRequest
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
            'family_relation_type_id' => 'required|integer|exists:family_relation_types,id',
            'surname' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'second_name' => 'required|string|max:100',
            'born_date' => 'required|date',
            'sex' => 'required|integer',
        ];
    }
}
