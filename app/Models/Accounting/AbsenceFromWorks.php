<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета отсутствия на работе
 */

class AbsenceFromWorks extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'absence_classifier_id',
        'start',
        'expiry',
        'rationale',
    ];
}
