<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonalTaxes: Модель учета налоговой информации работника
 *
 * @author SeBo
 */
class PersonalTaxes extends Model {

    use SoftDeletes;

    protected $fillable = [
        'personal_card_id',
        'tax_office_id',
        'tax_recipient_id',
    ];
}