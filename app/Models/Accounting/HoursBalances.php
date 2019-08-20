<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета распределения часов
 */

class HoursBalances extends Model
{
    use SoftDeletes;
}
