<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WorkOrders: Модель учета нарядов
 *
 * @author SeBo
 */
class WorkOrders extends Model {

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
        'year_id',
        'month_id',
    ];
}