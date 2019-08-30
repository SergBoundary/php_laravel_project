<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания расчета сумм начислений работникам
 */

class EmployeeAccrualCalculations extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'accrual_id',
        'algorithm_id',
        'tax_rate_id',
        'object_id',
        'accrual_amount',
        'start',
        'expiry',
        'save_of_analytics',
        'account_title',
    ];
}
