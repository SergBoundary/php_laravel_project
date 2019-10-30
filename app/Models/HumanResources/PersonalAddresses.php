<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonalAddresses: Модель учета адресов работника
 *
 * @author SeBo
 */
class PersonalAddresses extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'postcode',
        'city_id',
        'street',
        'house',
        'apartment',
    ];
}