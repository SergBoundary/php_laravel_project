<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccrualGroups: Модель списка групп видов начислений
 *
 * @author SeBo
 */
class AccrualGroups extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type',
    ];
}