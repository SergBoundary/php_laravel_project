<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка бухгалтерских счетов
 */

class Accounts extends Model
{
    use SoftDeletes;
}
