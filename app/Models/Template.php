<?php 
namespace Models; 

class Template extends BasedModel
{ 
    public function post(){
        return $this->hasMany(Post::class);
    }
}
