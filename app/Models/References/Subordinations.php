<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subordinations: Модель списка уровней должностей
 *
 * @author SeBo
 */
class Subordinations extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}