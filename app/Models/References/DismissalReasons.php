<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DismissalReasons: Модель списка оснований увольнения работника
 *
 * @author SeBo
 */
class DismissalReasons extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}