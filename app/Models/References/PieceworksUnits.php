<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PieceworksUnits: Модель списка единиц изменерия сдельных работ
 *
 * @author SeBo
 */
class PieceworksUnits extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}