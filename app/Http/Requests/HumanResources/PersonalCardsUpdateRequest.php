<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class PersonalCardsUpdateRequest extends FormRequest
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
            'personal_account' => 'required|string|max:10',
            'tax_number' => 'required|string|max:10',
            'surname' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'second_name' => 'required|string|max:100',
            'nationality_id' => 'required|integer|exists:nationalities,id',
            'national_surname' => 'string|max:100',
            'national_first_name' => 'string|max:100',
            'national_second_name' => 'string|max:100',
            'born_date' => 'required|date',
            'born_city_id' => 'required|integer|exists:cities,id',
            'born_region_id' => 'required|integer|exists:regions,id',
            'born_district_id' => 'required|integer|exists:districts,id',
            'born_country_id' => 'required|integer|exists:countries,id',
            'sex' => 'required|integer',
            'marital_status_id' => 'required|integer|exists:marital_statuses,id',
            'clothing_size_id' => 'required|integer|exists:clothing_sizes,id',
            'shoe_size_id' => 'required|integer|exists:shoe_sizes,id',
            'union_member' => 'required|boolean',
            'disability' => 'required|boolean',
            'disability_id' => 'integer|exists:disabilities,id',
            'pension_date' => 'date',
            'pension_certificate' => 'string|max:100',
            'photo_url' => 'string|max:255',
        ];
    }
}
