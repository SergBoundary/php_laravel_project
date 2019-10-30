<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ManningTables: Справочник. Штатное расписание - список количеств, окладов и квалификации работников
 *
 * @author SeBo
 */
class ManningTables extends Model {

    use SoftDeletes;

    protected $fillable = [
        'department_id',
        'position_id',
        'rank_id',
        'quantity',
        'salary',
        'tariff',
    ];
}