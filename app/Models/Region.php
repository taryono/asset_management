<?php

namespace Models;
 
class Region extends BasedModel
{ 
    public function country(){
        return $this->belongsTo(Country::class);
    } 

    public function city(){
        return $this->hasMany(City::class);
    }   

    public function child(){
        return City::class;
    }

    public function getTitle(){
        return "Daftar Kota/Kabupaten Untuk Provinsi ".$this->name;
    }

    public function getTemplate(){
        return "City::list";
    }
}
