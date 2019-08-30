<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета нарядов
 */

class WorkOrders extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'department_id',
        'object_id',
        'team_id',
        'account_id',
        'algorithm_id',
        'date',
        'number',
        'amount',
        'year',
        'month',
    ];
}
