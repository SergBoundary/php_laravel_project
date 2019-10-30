<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StudyModes: Модель списка режимов (форм) обучения
 *
 * @author SeBo
 */
class StudyModes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}