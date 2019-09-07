<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета документов работника для легализации пребывания в стране
 */

class MigrationDocuments extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'migartion_status_id',
        'type',
        'number',
        'date_issued',
        'date_expiration',
        'date_inclusion',
        'date_seizure',
    ];
}