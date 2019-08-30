<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка оснований увольнения работника
 */

class DismissalReasons extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];
}
