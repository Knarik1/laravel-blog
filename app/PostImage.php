<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable = [
        'image'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post','post_id','id');
    }
}
