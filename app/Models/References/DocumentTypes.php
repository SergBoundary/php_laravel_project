<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentTypes: Модель списка видов кадровых документов
 *
 * @author SeBo
 */
class DocumentTypes extends Model {

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