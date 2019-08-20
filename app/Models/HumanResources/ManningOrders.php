<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета должностных назначений
 */

class ManningOrders extends Model
{
    use SoftDeletes;
}
