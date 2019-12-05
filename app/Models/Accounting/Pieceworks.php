<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pieceworks: Модель учета сдельных работ
 *
 * @author SeBo
 */
class Pieceworks extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'year_id',
        'month_id',
        'object_id',
        'type',
        'unit',
        'quantity',
        'price',
    ];
}