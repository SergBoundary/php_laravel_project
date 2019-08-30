<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка месяцев
 */

class Months extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'number',
        'title',
    ];
}
