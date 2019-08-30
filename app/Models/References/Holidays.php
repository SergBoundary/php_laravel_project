<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка праздничных дней
 */

class Holidays extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'country_id',
        'year_id',
        'month_id',
        'holiday',
        'not_work',
        'religion',
    ];
}
