<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета трудового стаража работника
 */

class WorkExperiences extends Model
{
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
