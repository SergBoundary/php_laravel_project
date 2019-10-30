<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonalCitizenship: Модель учета гражданств работника
 *
 * @author SeBo
 */
class PersonalCitizenship extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'country_id',
        'start',
        'expiry',
    ];
}