<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceClassifiersCreateRequest extends FormRequest
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
            'absences_grouping_id' => 'required|integer|exists:grouping_types_of_absences,id',
            'title' => 'required|string|max:50',
            'abbr_absence' => 'required|string|max:4',
        ];
    }
}