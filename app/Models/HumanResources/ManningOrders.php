<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ManningOrders: Модель учета должностных назначений
 *
 * @author SeBo
 */
class ManningOrders extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'personal_card_id',
        'department_id',
        'position_id',
        'position_profession_id',
        'assignment_date',
        'resignation_date',
    ];
}