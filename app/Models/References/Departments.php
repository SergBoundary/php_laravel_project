<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка подразделений компании
 */

class Departments extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'department_group_id',
        'title',
        'department_attribute',
        'print_order',
    ];
}
