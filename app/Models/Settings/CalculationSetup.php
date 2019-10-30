<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CalculationSetup: Модель настроек финансовых параметров расчетов
 *
 * @author SeBo
 */
class CalculationSetup extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'condition',
        'value',
        'start',
        'expiry',
    ];
}