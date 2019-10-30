<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RecruitmentOrders: Модель учета найма и увольнений работника
 *
 * @author SeBo
 */
class RecruitmentOrders extends Model {

    use SoftDeletes;

    protected $fillable = [
        'document_id',
        'personal_card_id',
        'employment_date',
        'employment_order',
        'probation',
        'dismissal_date',
        'dismissal_order',
        'dismissal_reason_id',
    ];
}