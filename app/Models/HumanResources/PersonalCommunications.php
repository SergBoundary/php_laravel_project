<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета способов коммуникации с работником
 */

class PersonalCommunications extends Model
{
    use SoftDeletes;
}
