<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaxRates: Справочник. Классификатор налоговых ставок
 *
 * @author SeBo
 */
class TaxRates extends Model {

    use SoftDeletes;

    protected $fillable = [
        'accrual_id',
        'title',
    ];
}