<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета налоговой информации работника
 */

class PersonalTaxes extends Model
{
    use SoftDeletes;
}
