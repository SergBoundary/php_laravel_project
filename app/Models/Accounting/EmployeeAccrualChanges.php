<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета переформирования начислений работникам
 */

class EmployeeAccrualChanges extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'algorithm_id',
        'tax_rates_id',
        'date_to',
        'amount',
    ];
}
