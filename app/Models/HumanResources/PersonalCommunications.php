<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonalCommunications: Модель учета способов коммуникации с работником
 *
 * @author SeBo
 */
class PersonalCommunications extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'communication_type_id',
        'content',
    ];
}