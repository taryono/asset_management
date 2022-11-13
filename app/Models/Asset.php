<?php

namespace Models; 
class Asset extends BasedModel
{ 
    protected $appends = ['subtotal', 'harga']; 
    public function getSubtotalAttribute(){
        return rupiahFormat($this->amount * $this->price);
    } 

    public function getHargaAttribute(){
        return rupiahFormat($this->price);
    } 
 
    public function asset_type(){
        return $this->belongsTo(AssetType::class);
    }

    public function asset_status(){
        return $this->belongsTo(AssetStatus::class);
    }

    public function asset_category(){
        return $this->belongsTo(AssetCategory::class);
    } 
}
