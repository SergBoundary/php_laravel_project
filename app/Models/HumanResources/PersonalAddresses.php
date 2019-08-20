<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета адресов работника
 */

class PersonalAddresses extends Model
{
    use SoftDeletes;
}
