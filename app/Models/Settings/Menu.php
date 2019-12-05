<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menu: Модель настроек пользовательского меню системы
 *
 * @author SeBo
 */
class Menu extends Model {

    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'sort',
        'name',
        'path',
        'access_0',
        'access_1',
        'access_2',
        'access_3',
        'access_4',
    ];
}