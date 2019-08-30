<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class PersonalPasportsUpdateRequest extends FormRequest
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
            'series' => 'required|string|max:10',
            'number' => 'required|string|max:10',
            'issuing_date' => 'required|date',
            'issuing_authority' => 'required|string|max:30',
            'expiration date' => 'required|date',
        ];
    }
}
