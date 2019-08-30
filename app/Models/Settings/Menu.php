<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания настроек пользовательского меню системы
 */

class Menu extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'parent_id',
        'sort',
        'name',
        'url',
        'access_0',
        'access_1',
        'access_2',
        'access_3',
    ];
    
}
