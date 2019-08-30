<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class PhraseListsUpdateRequest extends FormRequest
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
            'phrase_group_id' => 'required|integer|exists:phrase_list_groups,id',
            'title' => 'required|string|max:100',
        ];
    }
}
