<?php

namespace App\Models\Calculations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания расчета заработной платы
 */

class Payrolls extends Model
{
    use SoftDeletes;
}
