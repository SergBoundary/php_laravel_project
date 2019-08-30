<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class AllocationsUpdateRequest extends FormRequest
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
            'object_id' => 'required|integer|exists:objects,id',
            'team_id' => 'required|integer|exists:teams,id',
            'document_id' => 'required|integer|exists:documents,id',
            'date' => 'required|date',
        ];
    }
}
