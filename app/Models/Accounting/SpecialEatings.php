<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета специального питания
 */

class SpecialEatings extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'year_id',
        'month_id',
        'residual_amount',
        'amount',
        'hours',
        'unit_price',
        'unit_quantity',
    ];
}
