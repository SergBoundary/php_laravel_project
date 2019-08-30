<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка групп формулировок для заполнения документов и форм 
 */

class PhraseListGroups extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
    ];
}
