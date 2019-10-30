<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VisaDocuments: Модель учета документов работника для получения визы и въезда в страну
 *
 * @author SeBo
 */
class VisaDocuments extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'visa_status_id',
        'type',
        'number',
        'date_issued',
        'date_expiration',
        'date_inclusion',
        'date_seizure',
    ];
}