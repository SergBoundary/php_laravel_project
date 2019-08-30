<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class DocumentTypesUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:80',
            'abbr' => 'required|string|max:10',
            'standart_status' => 'required|boolean',
            'standart_number' => 'required|string|max:10',
            'template_form' => 'required|string|max:50',
            'template_view' => 'required|string|max:100',
            'template_print' => 'required|string|max:100',
        ];
    }
}
