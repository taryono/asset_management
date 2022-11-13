<?php

namespace Models; 

class Role extends BasedModel
{ 
    public function users() {
        return $this->belongsToMany(\App\Models\User::class);
    }

    public function controllers() {
        return $this->belongsToMany(\Models\Controller::class);
    }

    public function menu() {
        return $this->belongsToMany(Menu::class);
    }

    public function gate(){
        return $this->belongsToMany(Gate::class);
    }

}
