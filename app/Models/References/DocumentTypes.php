<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка видов кадровых документов
 */

class DocumentTypes extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'abbr',
        'standart_status',
        'standart_number',
        'template_form',
        'template_view',
        'template_print',
    ];
}
