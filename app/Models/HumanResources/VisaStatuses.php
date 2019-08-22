<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета виз работника на пребывание в стране
 */

class VisaStatuses extends Model
{
    use SoftDeletes;
}
