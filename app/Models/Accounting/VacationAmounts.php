<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VacationAmounts: Модель расчета сумм отпускных
 *
 * @author SeBo
 */
class VacationAmounts extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'vacation_id',
        'accrual_id',
        'account_id',
        'year_id',
        'month_id',
        'calculation_year_id',
        'calculation_month_id',
        'date_from',
        'date_to',
        'calculation_type',
        'days',
        'hours',
        'days_unpaid',
        'days_paid',
        'days_total',
        'hours_total',
        'amount_days',
        'amount_hours',
        'amount_total',
        'percent',
    ];
}