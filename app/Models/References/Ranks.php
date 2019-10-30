<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ranks: Модель списка уровней квалификации (разрядов, рангов)
 *
 * @author SeBo
 */
class Ranks extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}