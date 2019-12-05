<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Teams: Модель учета формирования бригад
 *
 * @author SeBo
 */
class Teams extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'title',
        'abbr',
        'start',
        'expiry',
    ];
}