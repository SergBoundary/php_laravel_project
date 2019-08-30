<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка групп подразделений компании
 */

class DepartmentGroups extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];
}
