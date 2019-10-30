<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CalculationGroups: Модель списка видов расчетов
 *
 * @author SeBo
 */
class CalculationGroups extends Model {

    use SoftDeletes;

    protected $fillable = [
        'accrual_groups_id',
        'accrual_id',
        'calculation_attribute',
    ];
}