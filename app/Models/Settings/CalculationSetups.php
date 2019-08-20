<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания настроек финансовых параметров расчетов
 */

class CalculationSetups extends Model
{
    use SoftDeletes;
}
