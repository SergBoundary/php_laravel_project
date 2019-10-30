<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaxOffices: Модель списка налоговых инспекций
 *
 * @author SeBo
 */
class TaxOffices extends Model {

    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'district_id',
        'region_id',
        'city_id',
        'title',
    ];
}