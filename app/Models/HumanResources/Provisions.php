<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета материального обеспечения работника
 */

class Provisions extends Model
{
    use SoftDeletes;
}
