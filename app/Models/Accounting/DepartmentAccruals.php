<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета сумм начисления по подразделению
 */

class DepartmentAccruals extends Model
{
    use SoftDeletes;
}
