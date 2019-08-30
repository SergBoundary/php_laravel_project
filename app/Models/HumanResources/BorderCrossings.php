<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета пересечения границы страны пребывания работником
 */

class BorderCrossings extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'country_out_id',
        'country_in_id',
        'date',
        'comment',
    ];
}
