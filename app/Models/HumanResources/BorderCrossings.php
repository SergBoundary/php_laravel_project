<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета пересечения границы страны пребывания работником
 */

class BorderCrossings extends Model
{
    use SoftDeletes;
}
