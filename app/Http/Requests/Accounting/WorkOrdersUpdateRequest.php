<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class WorkOrdersUpdateRequest extends FormRequest
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
            'department_id' => 'required|integer|exists:departments,id',
            'object_id' => 'required|integer|exists:objects,id',
            'team_id' => 'required|integer|exists:teams,id',
            'account_id' => 'required|integer|exists:accounts,id',
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'date' => 'required|date',
            'number' => 'required|string|max:50',
            'amount' => 'required|numeric',
            'year' => 'required|integer',
            'month' => 'required|integer',
        ];
    }
}
