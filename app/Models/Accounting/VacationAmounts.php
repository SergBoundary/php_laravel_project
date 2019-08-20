<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания расчета сумм отпускных
 */

class VacationAmounts extends Model
{
    use SoftDeletes;
}
