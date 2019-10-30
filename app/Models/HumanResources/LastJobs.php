<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LastJobs: Модель учета предыдущих мест работы
 *
 * @author SeBo
 */
class LastJobs extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'last_job',
        'position_profession_id',
        'dismissal_date',
        'dismissal_reason',
    ];
}