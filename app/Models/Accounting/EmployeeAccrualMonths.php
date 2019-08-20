<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета сумм начислений работникам за месяц
 */

class EmployeeAccrualMonths extends Model
{
    use SoftDeletes;
}
