<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model {

    //use SoftDeletes;

    protected $fillable = [
        'country',
        'code',
        'title',
        'abbr',
    ];
}
