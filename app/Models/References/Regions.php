<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка районов
 */

class Regions extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'country_id',
        'district_id',
        'title',
        'national_name',
    ];
}
