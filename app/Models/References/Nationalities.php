<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Nationalities: Модель списка национальностей
 *
 * @author SeBo
 */
class Nationalities extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}