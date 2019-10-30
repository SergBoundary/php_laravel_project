<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GroupingTypesOfAbsences: Модель списка видов отсутствия на работе
 *
 * @author SeBo
 */
class GroupingTypesOfAbsences extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}