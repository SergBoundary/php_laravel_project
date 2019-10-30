<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pieceworks: Модель списка сдельных работ
 *
 * @author SeBo
 */
class Pieceworks extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'pieceworks_unit_id',
        'price',
        'accrual_id',
    ];
}