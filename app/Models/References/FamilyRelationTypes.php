<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка видов степени родства
 */

class FamilyRelationTypes extends Model
{
    use SoftDeletes;
}
