<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EducationTypes: Модель списка уровней образования
 *
 * @author SeBo
 */
class EducationTypes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}