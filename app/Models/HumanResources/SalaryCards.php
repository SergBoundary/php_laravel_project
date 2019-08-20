<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета зарплатных карт работника
 */

class SalaryCards extends Model
{
    use SoftDeletes;
}
