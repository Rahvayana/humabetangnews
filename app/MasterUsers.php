<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterUsers extends Authenticatable
{


    protected $table 	= 'master_users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'api_token',
        'email',
        'iss',
        'status',
        'picture',
        'uid',
        'expired_at'


    ];

    protected $hidden = [
        'password',
    ];

}
