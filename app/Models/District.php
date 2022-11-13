<?php

namespace Models; 

class District extends BasedModel
{ 
    public function subdistrict(){
        return $this->hasMany(Subdistrict::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function child(){
        return Subdistrict::class;
    }

    public function getTitle(){
        return "Daftar Kelurahan Untuk Kecamatan ".$this->name;
    }

    public function getTemplate(){
        return "Subdistrict::list";
    }
}
