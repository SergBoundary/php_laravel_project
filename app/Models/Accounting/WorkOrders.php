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
}
