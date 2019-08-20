<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка уровней должностей
 */

class Subordinations extends Model
{
    use SoftDeletes;
}
