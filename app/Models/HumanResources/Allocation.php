<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета должностных перемещений работника
 */

class Allocation extends Model
{
    use SoftDeletes;
}
