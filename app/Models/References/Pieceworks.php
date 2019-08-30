<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка сдельных работ
 */

class Pieceworks extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'piecework_unit_id',
        'price',
        'accrual_id',
    ];
}
