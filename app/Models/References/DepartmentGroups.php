<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DepartmentGroups: Модель списка групп подразделений компании
 *
 * @author SeBo
 */
class DepartmentGroups extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}