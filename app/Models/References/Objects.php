<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка объектов
 */

class Objects extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'object_group_id',
        'title',
    ];
}
