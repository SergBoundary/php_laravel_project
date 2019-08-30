<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета отработанного времени (табеля)
 */

class BaseTimesheets extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'year_id',
        'month_id',
        'accrual_id',
        'day-1',
        'day-2',
        'day-3',
        'day-4',
        'day-5',
        'day-6',
        'day-7',
        'day-8',
        'day-9',
        'day-10',
        'day-11',
        'day-12',
        'day-13',
        'day-14',
        'day-15',
        'day-16',
        'day-17',
        'day-18',
        'day-19',
        'day-20',
        'day-21',
        'day-22',
        'day-23',
        'day-24',
        'day-25',
        'day-26',
        'day-27',
        'day-28',
        'day-29',
        'day-30',
        'day-31',
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
