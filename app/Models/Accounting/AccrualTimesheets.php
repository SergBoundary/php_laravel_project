<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccrualTimesheets: Модель расчета сумм начислений работникам
 *
 * @author SeBo
 */
class AccrualTimesheets extends Model {

    use SoftDeletes;

    protected $fillable = [
        'accrual_id',
        'account_id',
        'base_timesheet_id',
        'object_id',
        'year_id',
        'month_id',
        'days',
        'hours',
    ];
}