<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class AccrualsCreateRequest extends FormRequest
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
            'accrual_group_id' => 'required|integer|exists:accrual_groups,id',
            'title' => 'required|string|max:10',
            'direction' => 'required|integer',
            'description' => 'required|string|max:50',
            'description_abbr' => 'required|string|max:10',
            'description_1с' => 'string|max:100',
            'algorithm_id' => 'required|integer|exists:algorithms,id',
            'accrual_sum' => 'required|numeric',
            'income_number_8dr' => 'required|integer',
            'calculation_number' => 'required|integer',
            'accrual_amount' => 'required|numeric',
            'accrual_analytics' => 'required|integer',
            'rounded amount' => 'required|integer',
            'rounded result' => 'required|integer',
            'account_title' => 'required|string|max:10',
            'object_id' => 'required|integer|exists:objects,id',
        ];
    }
}
