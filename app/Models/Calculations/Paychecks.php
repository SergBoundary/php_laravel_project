<?php

namespace App\Models\Calculations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания расчетного листа по заработной плате
 */

class Paychecks extends Model
{
    use SoftDeletes;
}
