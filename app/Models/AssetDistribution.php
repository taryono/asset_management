<?php

namespace Models;

use App\Models\User;

class AssetDistribution extends BasedModel
{
    public function user(){
        return $this->belongsTo(User::class);
     }

     public function location(){
        return $this->belongsTo(Location::class);
     }

     public function asset(){
      return $this->belongsTo(Asset::class);
   }
}
