<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmploymentTypes: Модель списка видов трудовых отношений
 *
 * @author SeBo
 */
class EmploymentTypes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}