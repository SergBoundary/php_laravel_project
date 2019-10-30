<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CommunicationTypes: Модель списка способов коммуникации с работником
 *
 * @author SeBo
 */
class CommunicationTypes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];
}