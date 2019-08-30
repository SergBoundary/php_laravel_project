<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета материального обеспечения работника
 */

class Provisions extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'document_id',
        'manning_orders_id',
        'date_from',
        'date_to',
        'amount',
        'rationale_title',
        'provision_date',
        'return_date',
    ];
}
