<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentAccrualsCreateRequest extends FormRequest
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
            'accrual_id' => 'required|integer|exists:accruals,id',
            'department_id' => 'required|integer|exists:departments,id',
            'team_id' => 'required|integer|exists:teams,id',
            'object_id' => 'required|integer|exists:objects,id',
            'accrual_amount' => 'required|numeric',
            'accrual_date' => 'required|date',
            'year' => 'required|integer',
            'month' => 'required|integer',
            'loaded' => 'required|integer',
        ];
    }
}
