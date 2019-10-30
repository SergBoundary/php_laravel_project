<?php

namespace App\Models\Calculations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payrolls: Модель обслуживания расчета заработной платы
 *
 * @author SeBo
 */
class Payrolls extends Model {

    use SoftDeletes;

    protected $fillable = [
    ];
}