<?php

namespace Models;

class AssetMaintenance extends BasedModel
{
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
