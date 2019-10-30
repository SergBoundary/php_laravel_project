<?php

namespace App\Models\Calculations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PayrollPreparations: Модель обслуживания подготовки расчета заработной платы
 *
 * @author SeBo
 */
class PayrollPreparations extends Model {

    use SoftDeletes;

    protected $fillable = [
    ];
}