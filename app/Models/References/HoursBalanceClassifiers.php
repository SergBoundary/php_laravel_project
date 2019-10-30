<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HoursBalanceClassifiers: Справочник. Классификатор графиков распределения рабочих часов в периоде
 *
 * @author SeBo
 */
class HoursBalanceClassifiers extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'monday_day',
        'tuesday_day',
        'wednesday_day',
        'thursday_day',
        'friday_day',
        'saturday_day',
        'sunday_day',
        'hours_reduction',
        'hourly_rate',
        'period',
        'monday_evening',
        'tuesday_evening',
        'wednesday_evening',
        'thursday_evening',
        'friday_evening',
        'saturday_evening',
        'sunday_evening',
        'monday_night',
        'tuesday_night',
        'wednesday_night',
        'thursday_night',
        'friday_night',
        'saturday_night',
        'sunday_night',
    ];
}