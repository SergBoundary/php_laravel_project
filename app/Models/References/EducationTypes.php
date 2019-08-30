<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка уровней образования
 */

class EducationTypes extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];
}
