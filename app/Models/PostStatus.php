<?php 
namespace Models;

use App\Models\User;

class PostStatus extends BasedModel
{    

    public function post(){
        return $this->hasMany(Post::class);
    }   

    public function slider(){
        return $this->hasMany(Slider::class);
    }  
    
    public function gallery(){
        return $this->hasMany(Gallery::class);
    } 
}