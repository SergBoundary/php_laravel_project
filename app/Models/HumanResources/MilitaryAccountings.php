<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания воинского учета работников
 */

class MilitaryAccountings extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'personal_card_id',
        'accounting_group',
        'accounting_category',
        'composition',
        'military_rank',
        'military_specialty',
        'military_suitability',
        'military_commissariat',
    ];
}
