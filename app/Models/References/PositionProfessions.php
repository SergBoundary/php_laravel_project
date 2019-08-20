<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания государственного классификатора профессий
 */

class PositionProfessions extends Model
{
    use SoftDeletes;
}
