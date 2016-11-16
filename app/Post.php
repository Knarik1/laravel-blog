<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        
        'text', 'heading', 'category', 'color'
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

    public function delete()
    {
        // delete all related photos
        $this->images()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }

    public function category()
    {
        
        return $this->belongsTo('App\Category','category_id','id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment','post_id','id');
    }
}
