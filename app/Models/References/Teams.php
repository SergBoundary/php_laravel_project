<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Teams: Модель списка бригад
 *
 * @author SeBo
 */
class Teams extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'abbr',
    ];
}