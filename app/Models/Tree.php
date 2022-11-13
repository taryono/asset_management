<?php 
namespace Models; 

class Tree extends BasedModel
{ 
    public function structure(){
        return $this->belongsTo(Structure::class);
    }
}