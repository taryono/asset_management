<?php

namespace Models;
 
use Models\BasedModel;

class Location extends BasedModel
{
    public function parent(){
        return $this->belongsTo(Location::class, 'parent_id', 'id');
    }
}
