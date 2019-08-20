<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета близкого окружения работника
 */

class EmployeeFamilies extends Model
{
    use SoftDeletes;
}
