<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class BorderCrossingsUpdateRequest extends FormRequest
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
            'country_out_id' => 'required|integer|exists:countries,id',
            'country_in_id' => 'required|integer|exists:countries,id',
            'date' => 'required|date',
            'comment' => 'string|max:50',
        ];
    }
}
