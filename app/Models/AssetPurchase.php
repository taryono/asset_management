<?php

namespace Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetPurchase extends BasedModel
{
     public function supplier(){
        return $this->belongsTo(Supplier::class);
     }
}
