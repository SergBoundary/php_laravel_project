<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка налоговых инспекций
 */

class TaxOffices extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'country_id',
        'district_id',
        'region_id',
        'city_id',
        'title',
    ];
}
