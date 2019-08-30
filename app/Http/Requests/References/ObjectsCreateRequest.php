<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class ObjectsCreateRequest extends FormRequest
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
            'object_group_id' => 'required|integer|exists:object_groups,id',
            'title' => 'required|string|max:255',
        ];
    }
}
