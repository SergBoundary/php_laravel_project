<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка видов расчетов
 */

class CalculationGroups extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'accrual_groups_id',
        'accrual_id',
        'calculation_attribute',
    ];
}
