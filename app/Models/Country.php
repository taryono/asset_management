<?php

namespace Models;
 
class Country extends BasedModel
{ 
    public function region(){
        return $this->hasMany(Region::class);
    } 

    public function child(){
        return Region::class;
    } 

    public function getTitle(){
        return "Daftar Provinsi Di {$this->name}";
    }

    public function getTemplate(){
        return "Region::list";
    }
}
