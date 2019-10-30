<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PhraseLists: Модель списка формулировок для заполнения документов и форм 
 *
 * @author SeBo
 */
class PhraseLists extends Model {

    use SoftDeletes;

    protected $fillable = [
        'phrase_group_id',
        'title',
    ];
}