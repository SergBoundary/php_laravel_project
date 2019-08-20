<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета предыдущих мест работы
 */

class LastJobs extends Model
{
    use SoftDeletes;
}
