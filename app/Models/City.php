<?php

namespace Models; 

class City extends BasedModel
{ 
    public function district(){
        return $this->hasMany(District::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function child(){
        return District::class;
    }

    public function getTitle(){
        return "Daftar Kecamatan Untuk Kota/Kabupaten ".$this->name;
    }

    public function getTemplate(){
        return "District::list";
    }
}
