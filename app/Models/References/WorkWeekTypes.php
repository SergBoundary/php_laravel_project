<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка видов рабочих недель
 */

class WorkWeekTypes extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];
}
