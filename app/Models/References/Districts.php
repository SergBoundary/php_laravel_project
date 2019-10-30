<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Districts: Модель списка областей (штатов, земель, воевудств)
 *
 * @author SeBo
 */
class Districts extends Model {

    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'title',
        'national_name',
        'number_iso',
    ];
}