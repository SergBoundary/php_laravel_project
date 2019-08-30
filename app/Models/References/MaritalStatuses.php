<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка видов семейного положения
 */

class MaritalStatuses extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];
}
