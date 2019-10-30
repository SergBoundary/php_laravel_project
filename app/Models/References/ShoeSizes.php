<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ShoeSizes: Модель списка размеров обуви
 *
 * @author SeBo
 */
class ShoeSizes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}