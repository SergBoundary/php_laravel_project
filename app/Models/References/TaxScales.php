<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания шкалы расчета подоходного налога
 */

class TaxScales extends Model
{
    use SoftDeletes;
}
