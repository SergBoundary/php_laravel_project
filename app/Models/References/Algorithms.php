<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Algorithms: Модель списка алгоритмов начислений
 *
 * @author SeBo
 */
class Algorithms extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}