<?php

namespace Models;
 
class AssetMaintenance extends BasedModel
{
    public function supplier(){
        return $this->belongsTo(Supplier::class);
     }

     public function vendor(){
        return $this->belongsTo(Vendor::class);
     }
}
