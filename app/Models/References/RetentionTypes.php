<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Objects: Модель списка объектов
 *
 * @author SeBo
 */
class RetentionTypes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'abbr',
    ];
}