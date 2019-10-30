<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AbsenceClassifiers: Справочник. Классификатор отсутствия на работе
 *
 * @author SeBo
 */
class AbsenceClassifiers extends Model {

    use SoftDeletes;

    protected $fillable = [
        'accrual_id',
        'absences_grouping_id',
        'title',
        'abbr',
    ];
}