<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonalEducations: Модель учета образования и квалификации работника
 *
 * @author SeBo
 */
class PersonalEducations extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'education_type_id',
        'study_mode_id',
        'institution',
        'specialty',
        'degree',
        'degree_abbr',
        'diploma',
    ];
}