<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Currencies: Модель списка валют
 *
 * @author SeBo
 */
class Currencies extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'symbol',
    ];
}