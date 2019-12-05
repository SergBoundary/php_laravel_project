<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Accruals: Модель учета начислений
 *
 * @author SeBo
 */
class Accruals extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'year_id',
        'month_id',
        'accrual_type_id',
        'amount',
    ];
}