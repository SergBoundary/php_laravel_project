<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vacations: Модель учета отпусков
 *
 * @author SeBo
 */
class Vacations extends Model {

    use SoftDeletes;

    protected $fillable = [
        'document_id',
        'personal_card_id',
        'absence_classifier_id',
        'period_start',
        'period_expiry',
        'period',
        'start',
        'expiry',
        'phrase_list_id',
        'work_days',
        'work_hours',
        'vacation_pay',
    ];
}