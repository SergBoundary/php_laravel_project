<?php

namespace App\Models\Calculations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Paychecks: Модель обслуживания расчетного листа по заработной плате
 *
 * @author SeBo
 */
class Paychecks extends Model {

    use SoftDeletes;

    protected $fillable = [
    ];
}