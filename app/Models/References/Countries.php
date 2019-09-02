<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка стран
 */

class Countries extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'national_name',
        'symbol_alfa2',
        'symbol_alfa3',
        'number_iso',
        'visible',
    ];
}
