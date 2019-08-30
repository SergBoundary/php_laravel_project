<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания настроек сохранения базы данных
 */

class SaveDatabases extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'module',
        'command',
        'parametr',
        'start',
        'expiry',
        'month_day',
        'week_day',
        'run_time',
        'condition',
    ];
}
