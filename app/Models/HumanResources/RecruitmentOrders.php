<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета найма и увольнений работника
 */

class RecruitmentOrders extends Model
{
    use SoftDeletes;
}
