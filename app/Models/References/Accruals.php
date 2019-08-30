<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания классификатора начислений
 */

class Accruals extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'accrual_group_id',
        'title',
        'direction',
        'description',
        'description_abbr',
        'description_1с',
        'algorithm_id',
        'accrual_sum',
        'income_number_8dr',
        'calculation_number',
        'accrual_amount',
        'accrual_analytics',
        'rounded amount',
        'rounded result',
        'account_title',
        'object_id',
    ];
}
