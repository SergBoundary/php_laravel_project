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
}
