<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class DocumentsUpdateRequest extends FormRequest
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
            'document_id' => 'required|integer|exists:documents,id',
            'date' => 'required|date',
            'number' => 'required|string|max:10',
            'annotation' => 'required|string|max:100',
            'description' => 'required|string',
            'print' => 'required|boolean',
            'document_type_id' => 'required|integer|exists:document_types,id',
            'personal_card_id' => 'required|integer|exists:personal_cards,id',
            'create_user_id' => 'required|integer|exists:users,id',
            'editor_user_id' => 'required|integer|exists:users,id',
        ];
    }
}
