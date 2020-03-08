<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruitmentOrders extends Model {

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'personal_card_id',
        'employment_date',
        'employment_order',
        'probation',
        'dismissal_date',
        'dismissal_order',
        'dismissal_reason',
    ];
}
