<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка размеров одежды
 */

class ClothingSizes extends Model
{
    use SoftDeletes;
}
