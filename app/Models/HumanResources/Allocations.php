<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета должностных перемещений работника
 */

class Allocations extends Model
{
    use SoftDeletes;
}
