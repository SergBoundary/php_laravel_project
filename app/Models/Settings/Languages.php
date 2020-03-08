<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Languages extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'title',
        'abbr',
    ];
}
