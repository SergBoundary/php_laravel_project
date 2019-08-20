<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка зависимостей начислений
 */

class AccrualRelations extends Model
{
    use SoftDeletes;
}
