<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class PositionProfessionsCreateRequest extends FormRequest
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
            'code' => 'required|string|max:10',
            'title' => 'required|string|max:255',
        ];
    }
}
