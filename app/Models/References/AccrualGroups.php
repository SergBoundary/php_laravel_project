<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка групп видов начислений
 */

class AccrualGroups extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'type',
    ];
}
