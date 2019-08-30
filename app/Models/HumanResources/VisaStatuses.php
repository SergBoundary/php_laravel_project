<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета виз работника на пребывание в стране
 */

class VisaStatuses extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'country_out_id',
        'country_in_id',
        'opening_reason ',
        'submitted',
        'incomplete',
        'visa_issued',
        'visa_type',
        'date_opening',
        'date_closing',
        'closing_reason ',
    ];
}
