<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Holidays: Модель списка праздничных дней
 *
 * @author SeBo
 */
class Holidays extends Model {

    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'year_id',
        'month_id',
        'holiday',
        'title',
        'not_work',
        'religion',
    ];
}