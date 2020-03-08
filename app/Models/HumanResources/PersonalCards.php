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
        'structura',
        'user_id',
        'personal_account',
        'surname',
        'first_name',
        'second_name',
        'full_name_latina',
        'sex',
        'born_date',
        'phone',
        'photo_url',
    ];
}