<?php

namespace App\Models\Calculations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClosingFinancialPeriods: Модель обслуживания закрытия финансового периода
 *
 * @author SeBo
 */
class ClosingFinancialPeriods extends Model {

    use SoftDeletes;

    protected $fillable = [
    ];
}