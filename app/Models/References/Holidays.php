<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка праздничных дней
 */

class Holidays extends Model
{
    use SoftDeletes;
}
