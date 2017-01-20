<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
	protected $fillable = ['steamid64', 'username', 'avatar', 'state'];
    protected $hidden = ['token', 'is_admin', 'remember_token'];
    
}
