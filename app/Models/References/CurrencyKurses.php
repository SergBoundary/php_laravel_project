<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка текущих курсов валют
 */

class CurrencyKurses extends Model
{
    use SoftDeletes;
}
