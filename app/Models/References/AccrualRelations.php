<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccrualRelations: Модель списка зависимостей начислений
 *
 * @author SeBo
 */
class AccrualRelations extends Model {

    use SoftDeletes;

    protected $fillable = [
        'accrual_id',
        'relation_attribute',
    ];
}