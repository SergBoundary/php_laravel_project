<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания списка формулировок для заполнения документов и форм 
 */

class PhraseLists extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'phrase_group_id',
        'title',
    ];
}
