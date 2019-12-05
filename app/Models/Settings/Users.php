<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Users: Модель учета пользователей системы
 *
 * @author SeBo
 */
class Users extends Model {

    //use SoftDeletes;

    protected $fillable = [
        'name',
        'personal_account',
        'email',
        'email_verified_at',
        'password',
        'access',
    ];
}