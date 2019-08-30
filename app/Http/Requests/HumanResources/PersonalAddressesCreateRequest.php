<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class PersonalAddressesCreateRequest extends FormRequest
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
            'postcode' => 'required|string|max:10',
            'city' => 'required|string|max:20',
            'street' => 'required|string|max:50',
            'house' => 'required|string|max:10',
            'apartment' => 'string|max:10',
        ];
    }
}
