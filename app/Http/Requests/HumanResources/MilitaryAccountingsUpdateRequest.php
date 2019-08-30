<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class MilitaryAccountingsUpdateRequest extends FormRequest
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
            'accounting_group' => 'required|string|max:50',
            'accounting_category' => 'required|string|max:50',
            'composition' => 'required|string|max:50',
            'military_rank' => 'required|string|max:50',
            'military_specialty' => 'required|string|max:50',
            'military_suitability' => 'required|integer',
            'military_commissariat' => 'required|string|max:50',
        ];
    }
}
