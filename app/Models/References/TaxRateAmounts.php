<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания классификатора сумм оплаты налогов
 */

class TaxRateAmounts extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'tax_rate_id',
        'date_from',
        'amount_from',
        'amount_to',
        'amount',
        'percent',
    ];
}
