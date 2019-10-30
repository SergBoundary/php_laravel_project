<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MaritalStatuses: Модель списка видов семейного положения
 *
 * @author SeBo
 */
class MaritalStatuses extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}