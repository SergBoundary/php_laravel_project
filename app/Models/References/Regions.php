<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка районов
 */

class Regions extends Model
{
    use SoftDeletes;
}
