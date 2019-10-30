<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SalaryCards: Модель учета зарплатных карт работника
 *
 * @author SeBo
 */
class SalaryCards extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'bank_id',
        'payment_card',
        'expiry',
    ];
}