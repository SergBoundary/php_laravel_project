<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка способов коммуникации с работником
 */

class CommunicationTypes extends Model
{
    use SoftDeletes;
}
