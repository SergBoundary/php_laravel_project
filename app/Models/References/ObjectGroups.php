<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ObjectGroups: Модель списка групп объектов
 *
 * @author SeBo
 */
class ObjectGroups extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}