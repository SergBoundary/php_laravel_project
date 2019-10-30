<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WorkExperiences: Модель учета трудового стаража работника
 *
 * @author SeBo
 */
class WorkExperiences extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'position_profession_id',
        'work_experience_years',
        'work_experience_months',
        'work_experience_days',
        'work_experience_continuous',
    ];
}