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
}
