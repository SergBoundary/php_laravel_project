<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка алгоритмов начислений
 */

class Algorithms extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];
}
