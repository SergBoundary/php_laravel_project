<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Banks: Модель списка банков
 *
 * @author SeBo
 */
class Banks extends Model {

    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'title',
        'commission',
    ];
}