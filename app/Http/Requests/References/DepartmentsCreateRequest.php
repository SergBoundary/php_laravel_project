<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentsCreateRequest extends FormRequest
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
            'department_group_id' => 'required|integer|exists:department_groups,id',
            'title' => 'required|string|max:50',
            'department_attribute' => 'required|integer',
            'print_order' => 'required|integer',
        ];
    }
}
