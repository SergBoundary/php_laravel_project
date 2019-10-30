<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalCardsUpdateRequest: Правила записи неизменяемых персональных данных
 *
 * @author SeBo
 *
 * @package App\Http\Requests
 */
class PersonalCardsUpdateRequest extends FormRequest {

    /**
     * Создает реквест, если пользователь авторизован.
     *
     * @return bool
     */
    public function authorize() {
        return auth()->check();
    }

    /**
     * Получает правила проверки данных для реквеста.
     *
     * @return array
     */
    public function rules() {
        return [
//            'personal_account' => 'required|string|max:15',
//            'tax_number' => 'string|max:10',
//            'surname' => 'required|string|max:100',
//            'first_name' => 'required|string|max:100',
//            'second_name' => 'required|string|max:100',
//            'nationality_id' => 'integer|exists:nationalities,id',
//            'full_name_latina' => 'string|max:100',
//            'born_date' => 'required|date',
//            'born_city_id' => 'integer|exists:cities,id',
//            'born_region_id' => 'integer|exists:regions,id',
//            'born_district_id' => 'integer|exists:districts,id',
//            'born_country_id' => 'integer|exists:countries,id',
//            'sex' => 'required|integer',
//            'marital_status_id' => 'required|integer|exists:marital_statuses,id',
//            'clothing_size_id' => 'integer|exists:clothing_sizes,id',
//            'shoe_size_id' => 'integer|exists:shoe_sizes,id',
//            'union_member' => 'boolean',
//            'disability' => 'boolean',
//            'disability_id' => 'integer|exists:disabilities,id',
//            'pension_date' => 'date',
//            'pension_certificate' => 'string|max:100',
//            'photo_url' => 'string|max:255',
        ];
    }
}