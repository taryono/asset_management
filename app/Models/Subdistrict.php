<?php

namespace Models; 

class Subdistrict extends BasedModel
{ 
    public function rw(){
        return $this->hasMany(Rw::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function child(){
        return Rw::class;
    }

    public function getTitle(){
        return "Daftar RW Untuk Kelurahan ".$this->name;
    }

    public function getTemplate(){
        return "Rw::list";
    }
}
