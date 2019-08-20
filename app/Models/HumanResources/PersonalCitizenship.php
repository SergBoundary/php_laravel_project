<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета гражданств работника
 */

class PersonalCitizenship extends Model
{
    use SoftDeletes;
}
