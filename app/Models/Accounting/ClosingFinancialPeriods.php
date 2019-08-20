<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания закрытия финансового периода
 */

class ClosingFinancialPeriods extends Model
{
    use SoftDeletes;
}
