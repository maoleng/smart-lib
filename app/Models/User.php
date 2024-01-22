<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'login_code',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'login_code',
    ];

}
