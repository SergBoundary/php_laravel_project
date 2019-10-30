<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PositionCategories: Модель списка категорий должностей
 *
 * @author SeBo
 */
class PositionCategories extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}