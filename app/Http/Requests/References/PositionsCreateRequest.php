<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class PositionsCreateRequest extends FormRequest
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
            'subordination_id' => 'required|integer|exists:subordinations,id',
            'position_profession_id' => 'required|integer|exists:position_professions,id',
            'position_category_id' => 'required|integer|exists:position_categories,id',
            'title' => 'required|string|max:100',
        ];
    }
}
