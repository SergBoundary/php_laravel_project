<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmployeeAccrualMonths: Модель учета сумм начислений работникам за месяц
 *
 * @author SeBo
 */
class EmployeeAccrualMonths extends Model {

    use SoftDeletes;

    protected $fillable = [
        'calculation_year_id',
        'calculation_month_id',
        'department_id',
        'position_id',
        'object_id',
        'team_id',
        'personal_card_id',
        'accrual_id',
        'employment_type_id',
        'year_id',
        'month_id',
        'account_id',
        'tax_scale_id',
        'accrual_amount',
        'retention_amount',
        'days',
        'hours',
        'analytics',
        'currency_id',
        'currency_amount',
        'currency_kurs_id',
        'tariff',
        'ssc_amount',
        'ssc_amount_disability',
        'ssc_amount_sickness',
        'ssc_amount_disability_sickness',
        'ssc_amount_civil_contract',
        'retention_date',
        'comment',
    ];
}