<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета отработанного времени (табеля)
 */

class BaseTimesheets extends Model
{
    use SoftDeletes;
}
