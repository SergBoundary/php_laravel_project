<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания учета кадровых документов
 */

class Documents extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'document_id',
        'date',
        'number',
        'annotation',
        'description',
        'print',
        'document_type_id',
        'personal_card_id',
        'create_user_id',
        'editor_user_id',
    ];
}
