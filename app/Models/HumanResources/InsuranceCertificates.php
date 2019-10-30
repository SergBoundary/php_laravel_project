<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InsuranceCertificates: Модель учета страховых свидетельств работника
 *
 * @author SeBo
 */
class InsuranceCertificates extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'certificate_series',
        'certificate_number',
        'insurance_fee',
        'certificate_expiry',
    ];
}