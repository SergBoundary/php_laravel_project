<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonalPasports: Модель учета паспортов работника
 *
 * @author SeBo
 */
class PersonalPasports extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'series',
        'number',
        'issuing_date',
        'issuing_authority',
        'expiration date',
    ];
}