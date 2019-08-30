<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания настроек восстановления базы данных
 */

class RestoreDatabases extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'module',
        'command',
        'parametr',
        'condition',
    ];
}
