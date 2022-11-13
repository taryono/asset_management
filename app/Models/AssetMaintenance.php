<?php

namespace Models;
 
class AssetMaintenance extends BasedModel
{
    public function vendor(){
        return $this->belongsTo(Vendor::class);
     }
}
