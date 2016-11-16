<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text', 'likes', 'dislikes'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post','post_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function belong_to_comment()
    {
        return $this->belongsTo('App\Comment','belong_to','id');
    }
    
    public function replies()
    {
        return $this->hasMany('App\Comment','belong_to','id');
    }
}
