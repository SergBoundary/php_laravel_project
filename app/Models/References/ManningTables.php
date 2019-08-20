<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания штатного расписания - списка количеств, окладов и квалификации работников
 */

class ManningTables extends Model
{
    use SoftDeletes;
}
