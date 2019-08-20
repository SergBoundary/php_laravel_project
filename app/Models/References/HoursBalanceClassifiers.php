<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания классификатора графиков распределения рабочих часов в периоде
 */

class HoursBalanceClassifiers extends Model
{
    use SoftDeletes;
}
