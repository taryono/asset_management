<?php

namespace Models; 

class AssetCategory extends BasedModel
{
    public function asset(){
        return $this->hasMany(Asset::class);
    } 
}
