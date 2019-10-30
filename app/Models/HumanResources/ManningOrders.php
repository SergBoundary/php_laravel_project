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
        'personal_card_id',
        'manning_table_id',
        'assignment_date',
        'assignment_order',
        'resignation_date',
        'resignation_order',
        'salary',
        'tariff',
    ];
}