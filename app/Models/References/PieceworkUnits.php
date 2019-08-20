<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка единиц изменерия сдельных работ
 */

class PieceworkUnits extends Model
{
    use SoftDeletes;
}
