<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaxScales: Справочник. Шкала расчета подоходного налога
 *
 * @author SeBo
 */
class TaxScales extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'lower amount',
        'top amount',
        'tax percentage',
    ];
}