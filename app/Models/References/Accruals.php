<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания классификатора начислений
 */

class Accruals extends Model
{
    use SoftDeletes;
}
