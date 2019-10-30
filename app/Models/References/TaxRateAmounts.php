<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaxRateAmounts: Справочник. Классификатор сумм оплаты налогов
 *
 * @author SeBo
 */
class TaxRateAmounts extends Model {

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