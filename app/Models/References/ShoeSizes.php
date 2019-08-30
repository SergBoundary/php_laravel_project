<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка размеров обуви
 */

class ShoeSizes extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];
}
