<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonalCards: Модель учета неизменяемых персональных данных
 *
 * @author SeBo
 */
class PersonalCards extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_account',
        'tax_number',
        'surname',
        'first_name',
        'second_name',
        'full_name_latina',
        'sex',
        'born_date',
        'photo_url',
    ];
}