<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания расчета сумм начислений работникам
 */

class AccrualTimesheets extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'accrual_id',
        'account_id',
        'base_timesheet_id',
        'object_id',
        'days',
        'hours',
        'month',
        'year',
    ];
}
