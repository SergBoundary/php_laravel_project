<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FamilyRelationTypes: Модель списка видов степени родства
 *
 * @author SeBo
 */
class FamilyRelationTypes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}