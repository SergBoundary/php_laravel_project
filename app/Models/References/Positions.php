<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Positions: Модель списка должностей
 *
 * @author SeBo
 */
class Positions extends Model {

    use SoftDeletes;

    protected $fillable = [
        'subordination_id',
        'position_profession_id',
        'position_category_id',
        'title',
    ];
}