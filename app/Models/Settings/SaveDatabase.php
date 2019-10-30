<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SaveDatabase: Модель настроек сохранения базы данных
 *
 * @author SeBo
 */
class SaveDatabase extends Model {

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