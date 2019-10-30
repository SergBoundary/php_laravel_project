<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Departments: Модель списка подразделений компании
 *
 * @author SeBo
 */
class Departments extends Model {

    use SoftDeletes;

    protected $fillable = [
        'department_group_id',
        'title',
        'abbr',
        'department_attribute',
        'print_order',
    ];
}