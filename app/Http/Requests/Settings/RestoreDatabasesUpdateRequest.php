<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class RestoreDatabasesUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'module' => 'required|string|max:50',
            'command' => 'required|string|max:50',
            'parametr' => 'required|string|max:50',
            'condition' => 'required|string|max:255',
        ];
    }
}
