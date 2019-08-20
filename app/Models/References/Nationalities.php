<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка национальностей
 */

class Nationalities extends Model
{
    use SoftDeletes;
}
