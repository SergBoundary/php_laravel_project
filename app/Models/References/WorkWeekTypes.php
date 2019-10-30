<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WorkWeekTypes: Модель списка видов рабочих недель
 *
 * @author SeBo
 */
class WorkWeekTypes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}