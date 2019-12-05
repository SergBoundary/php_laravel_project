<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Allocations: Модель учета должностных назначений работника
 *
 * @author SeBo
 */
class Allocations extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'object_id',
        'team_id',
        'start',
        'expiry',
    ];
}