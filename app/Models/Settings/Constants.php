<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания констант системы
 */

class Constants extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'value_number',
        'value_string',
        'start',
        'expiry',
    ];
}
