<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        
        'text', 'heading', 'color'
    ];
    protected $hidden = [
         'remember_token',
    ];

    public function user(){

        return $this->belongsTo('App\User');
    }
    
    public function images(){
        
        return $this->hasMany('App\PostImage','post_id','id');
    }
}
