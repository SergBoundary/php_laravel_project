<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompanyData: Модель реквизитов компании
 *
 * @author SeBo
 */
class CompanyData extends Model {

    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'data_short',
        'data_full',
        'start',
        'expiry',
    ];
}