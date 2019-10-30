<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BaseTimesheets: Модель учета отработанного времени (табель)
 *
 * @author SeBo
 */
class BaseTimesheets extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'year_id',
        'month_id',
        'accrual_id',
        'day_1',
        'day_2',
        'day_3',
        'day_4',
        'day_5',
        'day_6',
        'day_7',
        'day_8',
        'day_9',
        'day_10',
        'day_11',
        'day_12',
        'day_13',
        'day_14',
        'day_15',
        'day_16',
        'day_17',
        'day_18',
        'day_19',
        'day_20',
        'day_21',
        'day_22',
        'day_23',
        'day_24',
        'day_25',
        'day_26',
        'day_27',
        'day_28',
        'day_29',
        'day_30',
        'day_31',
        'hours_balance_classifier_id',
        'department_id',
        'amount',
        'actual_days',
        'vacation_days',
        'childbirth_leave',
        'sick_days',
        'other_days',
        'unpaid_leave',
        'absense from work',
        'weekend',
        'holidays',
        'hours',
        'night_hours',
        'overtime',
        'account_id',
        'position_id',
        'object_id',
    ];
}