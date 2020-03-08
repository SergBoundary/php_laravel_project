<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interfaces extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'modul',
        'element',
        'en',
        'pl',
        'ru',
        'ua',
    ];
}
