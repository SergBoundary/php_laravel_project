<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета переформирования начислений работникам
 */

class EmployeeAccrualChanges extends Model
{
    use SoftDeletes;
}
