<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Disabilities: Модель списка групп инвалидности
 *
 * @author SeBo
 */
class Disabilities extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}