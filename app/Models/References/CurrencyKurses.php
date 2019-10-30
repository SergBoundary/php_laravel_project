<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CurrencyKurses: Модель списка текущих курсов валют
 *
 * @author SeBo
 */
class CurrencyKurses extends Model {

    use SoftDeletes;

    protected $fillable = [
        'base currency_id',
        'quoted currency_id',
        'scale',
        'residual',
        'bay',
        'sell',
    ];
}