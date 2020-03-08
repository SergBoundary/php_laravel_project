<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotels extends Model {

    use SoftDeletes;

    protected $fillable = [
        'city',
        'house_type',
        'address',
        'contragent',
        'phone',
        'messenger',
        'beds',
    ];
}
