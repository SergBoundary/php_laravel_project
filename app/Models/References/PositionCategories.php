<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка категорий должностей
 */

class PositionCategories extends Model
{
    use SoftDeletes;
}
