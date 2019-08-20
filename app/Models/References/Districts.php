<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка областей (штатов, земель, воеводств)
 */

class Districts extends Model
{
    use SoftDeletes;
}
