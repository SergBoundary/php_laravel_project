<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menus: Модель настроек пользовательского меню системы
 *
 * @author SeBo
 */
class Menus extends Model {

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
