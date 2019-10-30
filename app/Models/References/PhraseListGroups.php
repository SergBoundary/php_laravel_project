<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PhraseListGroups: Модель списка групп формулировок для заполнения документов и форм 
 *
 * @author SeBo
 */
class PhraseListGroups extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}