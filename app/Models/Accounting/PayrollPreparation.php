<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания подготовки расчета заработной платы
 */

class PayrollPreparation extends Model
{
    use SoftDeletes;
}
