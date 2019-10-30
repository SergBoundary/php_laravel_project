<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cities: Модель списка населенных пунктов
 *
 * @author SeBo
 */
class Cities extends Model {

    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'district_id',
        'region_id',
        'title',
        'national_name',
    ];
}