<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета образования и квалификации работника
 */

class PersonalEducations extends Model
{
    use SoftDeletes;
}
