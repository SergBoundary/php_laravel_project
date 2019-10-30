<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RestoreDatabase: Модель настроек восстановления базы данных
 *
 * @author SeBo
 */
class RestoreDatabase extends Model {

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