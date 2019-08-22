<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета миграционного статуса работника в стране
 */

class MigartionStatuses extends Model
{
    use SoftDeletes;
}
