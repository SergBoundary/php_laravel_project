<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета сумм начисления по подразделению
 */

class DepartmentAccruals extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'accrual_id',
        'department_id',
        'team_id',
        'object_id',
        'accrual_amount',
        'accrual_date',
        'year',
        'month',
        'loaded',
    ];
}
