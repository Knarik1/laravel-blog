<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
       return $this->belongsTo('App\Role','role_id');
    }

    /**
     * one User has many posts, so with this function we can get the posts for the User
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
