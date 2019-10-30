<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Constants: Модель констант системы
 *
 * @author SeBo
 */
class Constants extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'value_number',
        'value_string',
        'start',
        'expiry',
    ];
}