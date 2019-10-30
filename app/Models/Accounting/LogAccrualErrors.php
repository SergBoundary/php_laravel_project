<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LogAccrualErrors: Модель ошибок в расчете начислений работникам
 *
 * @author SeBo
 */
class LogAccrualErrors extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'message',
        'error_type',
    ];
}