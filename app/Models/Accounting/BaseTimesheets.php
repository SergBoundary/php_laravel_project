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
        'user_id',
        'team_id',
        'personal_card_id',
        'year_id',
        'month_id',
        'object_id',
        'hours_day_1',
        'hours_day_2',
        'hours_day_3',
        'hours_day_4',
        'hours_day_5',
        'hours_day_6',
        'hours_day_7',
        'hours_day_8',
        'hours_day_9',
        'hours_day_10',
        'hours_day_11',
        'hours_day_12',
        'hours_day_13',
        'hours_day_14',
        'hours_day_15',
        'hours_day_16',
        'hours_day_17',
        'hours_day_18',
        'hours_day_19',
        'hours_day_20',
        'hours_day_21',
        'hours_day_22',
        'hours_day_23',
        'hours_day_24',
        'hours_day_25',
        'hours_day_26',
        'hours_day_27',
        'hours_day_28',
        'hours_day_29',
        'hours_day_30',
        'hours_day_31',
        'rate_day_1',
        'rate_day_2',
        'rate_day_3',
        'rate_day_4',
        'rate_day_5',
        'rate_day_6',
        'rate_day_7',
        'rate_day_8',
        'rate_day_9',
        'rate_day_10',
        'rate_day_11',
        'rate_day_12',
        'rate_day_13',
        'rate_day_14',
        'rate_day_15',
        'rate_day_16',
        'rate_day_17',
        'rate_day_18',
        'rate_day_19',
        'rate_day_20',
        'rate_day_21',
        'rate_day_22',
        'rate_day_23',
        'rate_day_24',
        'rate_day_25',
        'rate_day_26',
        'rate_day_27',
        'rate_day_28',
        'rate_day_29',
        'rate_day_30',
        'rate_day_31',
        'hours',
        'rate',
        'hourly',
        'piecework',
        'return_fix',
        'retention_fix',
        'penalty',
        'prepaid_expense',
        'food',
        'work_clothes',
        'total',
    ];
}