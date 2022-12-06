<?php

namespace Models; 

class AssetRequest extends BasedModel
{
    public function asset(){
        return $this->hasMany(Asset::class);
    } 
}
