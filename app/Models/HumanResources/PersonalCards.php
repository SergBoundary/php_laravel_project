<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета неизменяемых персональных данных
 */

class PersonalCards extends Model
{
    use SoftDeletes;
}
