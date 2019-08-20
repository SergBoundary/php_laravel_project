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
}
