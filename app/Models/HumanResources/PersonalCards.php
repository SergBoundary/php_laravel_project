<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета неизменяемых персональных данных
 */

class PersonalCards extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_account',
        'tax_number',
        'surname',
        'first_name',
        'second_name',
        'nationality_id',
        'national_surname',
        'national_first_name',
        'national_second_name',
        'born_date',
        'born_city_id',
        'born_region_id',
        'born_district_id',
        'born_country_id',
        'sex',
        'marital_status_id',
        'clothing_size_id',
        'shoe_size_id',
        'union_member',
        'disability',
        'disability_id',
        'pension_date',
        'pension_certificate',
        'photo_url',
    ];
}
