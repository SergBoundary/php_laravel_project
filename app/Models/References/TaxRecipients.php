<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaxRecipients: Модель списка получателей подоходного налога
 *
 * @author SeBo
 */
class TaxRecipients extends Model {

    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'district_id',
        'region_id',
        'city_id',
        'title',
    ];
}