<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClothingSizes: Модель списка размеров одежды
 *
 * @author SeBo
 */
class ClothingSizes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}