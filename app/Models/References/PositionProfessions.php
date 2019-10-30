<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PositionProfessions: Справочник. Государственный классификатор профессий
 *
 * @author SeBo
 */
class PositionProfessions extends Model {

    use SoftDeletes;

    protected $fillable = [
        'code',
        'title',
    ];
}