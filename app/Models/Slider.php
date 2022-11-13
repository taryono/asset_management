<?php

namespace Models;
 

class Slider extends BasedModel
{ 
    public function post_status(){
        return $this->belongsTo(PostStatus::class);
    } 
}
