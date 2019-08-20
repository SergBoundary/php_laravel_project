<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания классификатора отсутствия на работе
 */

class AbsenceClassifiers extends Model
{
    use SoftDeletes;
}
