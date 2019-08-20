<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка уровней квалификации (разрядов, рангов)
 */

class Ranks extends Model
{
    use SoftDeletes;
}
