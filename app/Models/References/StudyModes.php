<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка режимов (форм) обучения
 */

class StudyModes extends Model
{
    use SoftDeletes;
}
