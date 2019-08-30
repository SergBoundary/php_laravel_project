<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета сумм нарядов
 */

class WorkOrdersAmounts extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'work_order_id',
        'piecework_id',
        'account_id',
        'object_id',
        'algorithm_id',
        'quantity',
        'price',
        'amount',
        'holidays_amount',
        'hours',
    ];
}
