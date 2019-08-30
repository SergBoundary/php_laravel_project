<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class ManningOrdersUpdateRequest extends FormRequest
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
            'manning_table_id' => 'required|integer|exists:manning_tables,id',
            'assignment_date' => 'required|date',
            'assignment_order' => 'required|string|max:10',
            'resignation_date' => 'required|date',
            'resignation_order' => 'required|string|max:10',
            'salary' => 'required|numeric',
            'tariff' => 'required|numeric',
        ];
    }
}
