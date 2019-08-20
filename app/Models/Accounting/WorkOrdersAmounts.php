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
}
