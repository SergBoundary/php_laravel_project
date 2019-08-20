<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета сумм начислений работникам за год
 */

class EmployeeAccrualYears extends Model
{
    use SoftDeletes;
}
