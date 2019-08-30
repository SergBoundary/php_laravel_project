<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета страховых свидетельств работника
 */

class InsuranceCertificates extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'certificate_series',
        'certificate_number',
        'insurance_fee',
        'certificate_expiry',
    ];
}
