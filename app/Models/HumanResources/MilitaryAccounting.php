<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания воинского учета работников
 */

class MilitaryAccounting extends Model
{
    use SoftDeletes;
}
