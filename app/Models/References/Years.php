<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Years: Модель списка годов
 *
 * @author SeBo
 */
class Years extends Model {

    use SoftDeletes;

    protected $fillable = [
        'number',
    ];
}