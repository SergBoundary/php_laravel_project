<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания классификатора налоговых ставок
 */

class TaxRates extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'accrual_id',
        'title',
    ];
}
