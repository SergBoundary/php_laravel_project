<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка должностей
 */

class Positions extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'subordination_id',
        'position_profession_id',
        'position_category_id',
        'title',
    ];
}
