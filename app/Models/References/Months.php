<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Months: Модель списка месяцев
 *
 * @author SeBo
 */
class Months extends Model {

    use SoftDeletes;

    protected $fillable = [
        'number',
        'title',
    ];
}