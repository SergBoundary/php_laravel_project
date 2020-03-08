<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Retentions: Модель учета удержаний
 *
 * @author SeBo
 */
class Retentions extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'personal_card_id',
        'year_id',
        'month_id',
        'retention_type_id',
        'amount',
    ];
}