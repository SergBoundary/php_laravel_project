<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class ProvisionsUpdateRequest extends FormRequest
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
            'document_id' => 'required|integer|exists:documents,id',
            'manning_orders_id' => 'required|integer|exists:manning_orders,id',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'amount' => 'required|numeric',
            'rationale_title' => 'required|string|max:100',
            'provision_date' => 'required|date',
            'return_date' => 'required|date',
        ];
    }
}
