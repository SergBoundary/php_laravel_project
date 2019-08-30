<?php

namespace App\Http\Requests\References;

use Illuminate\Foundation\Http\FormRequest;

class AccountsCreateRequest extends FormRequest
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
            'title' => 'required|string|max:10',
            'description' => 'required|string|max:50',
            'account_balance_type' => 'required|string|max:3',
            'balance_type' => 'required|integer',
            'task' => 'required|integer',
            'currency_status' => 'required|boolean',
            'transaction_report' => 'required|string|max:3',
            'choose_account' => 'required|boolean',
            'inventory' => 'required|string|max:10',
            'inventory_write_off' => 'required|integer',
            'clients' => 'required|integer',
            'account_objects' => 'required|integer',
            'fixed_assets' => 'required|string|max:10',
            'main_warehouse' => 'required|integer',
            'amount_type' => 'required|integer',
            'type' => 'required|integer',
            'gross_costs' => 'required|string|max:9',
        ];
    }
}
