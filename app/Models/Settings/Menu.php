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
    
}
