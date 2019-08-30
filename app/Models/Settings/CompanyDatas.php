<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель обслуживания реквизитов компании
 */

class CompanyDatas extends Model
{
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
