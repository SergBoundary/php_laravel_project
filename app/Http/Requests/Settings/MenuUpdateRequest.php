<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class MenuUpdateRequest extends FormRequest
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
            'parent_id' => 'required|integer|exists:menus,id',
            'sort' => 'required|integer',
            'name' => 'required|string|max:30',
            'url' => 'required|string|max:20',
            'access_0' => 'required|boolean',
            'access_1' => 'required|boolean',
            'access_2' => 'required|boolean',
            'access_3' => 'required|boolean',
        ];
    }
}
