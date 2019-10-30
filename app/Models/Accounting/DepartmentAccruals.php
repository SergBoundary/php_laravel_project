<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DepartmentAccruals: Модель учета сумм начисления по подразделению
 *
 * @author SeBo
 */
class DepartmentAccruals extends Model {

    use SoftDeletes;

    protected $fillable = [
        'accrual_id',
        'department_id',
        'team_id',
        'object_id',
        'accrual_amount',
        'accrual_date',
        'year_id',
        'month_id',
        'loaded',
    ];
}