<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания расчета сумм начислений работникам
 */

class EmployeeAccrualCalculations extends Model
{
    use SoftDeletes;
}
