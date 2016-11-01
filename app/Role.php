<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'roles_id', 'roles', 'user_id'
    ];
    protected $timestamp = false;
    
//Relation one to many

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
