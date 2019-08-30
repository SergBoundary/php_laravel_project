<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета сумм начислений работникам
 */

class EmployeeAccruals extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'department_id',
        'department_accrual_id',
        'personal_card_id',
        'accrual_amount',
        'year_id',
        'month_id',
        'days',
        'hours',
        'team_id',
        'object_id',
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
