<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmployeeFamilies: Модель учета влияния близкого окружения
 *
 * @author SeBo
 */
class EmployeeFamilies extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'family_relation_type_id',
        'surname',
        'first_name',
        'second_name',
        'born_date',
        'sex',
    ];
}