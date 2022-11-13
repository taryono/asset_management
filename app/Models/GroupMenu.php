<?php

namespace Models; 

class GroupMenu extends BasedModel
{ 
    public function parent() {
        return $this->belongsTo(\Models\GroupMenu::class);
    }

    public function controller() {
        return $this->hasMany(Controller::class);
    }
}
