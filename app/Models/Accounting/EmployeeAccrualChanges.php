<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmployeeAccrualChanges: Модель учета переформирования начислений работникам
 *
 * @author SeBo
 */
class EmployeeAccrualChanges extends Model {

    use SoftDeletes;

    protected $fillable = [
        'algorithm_id',
        'tax_rates_id',
        'date_to',
        'amount',
    ];
}