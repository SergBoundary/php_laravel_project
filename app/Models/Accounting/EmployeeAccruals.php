<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmployeeAccruals: Модель учета сумм начислений работникам
 *
 * @author SeBo
 */
class EmployeeAccruals extends Model {

    use SoftDeletes;

    protected $fillable = [
        'department_id',
        'department_accrual_id',
        'team_id',
        'object_id',
        'personal_card_id',
        'year_id',
        'month_id',
        'days',
        'hours',
        'accrual_amount',
        'account_title',
        'currency_id',
        'currency_amount',
        'currency_kurs_id',
        'tariff',
        'calculation_year',
        'calculation_month',
        'comment',
    ];
}