<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmployeeAccrualCalculations: Модель расчета сумм начислений работникам
 *
 * @author SeBo
 */
class EmployeeAccrualCalculations extends Model {

    use SoftDeletes;

    protected $fillable = [
        'object_id',
        'personal_card_id',
        'accrual_id',
        'algorithm_id',
        'tax_id',
        'accrual_amount',
        'start',
        'expiry',
        'save_of_analytics',
        'account_title',
    ];
}