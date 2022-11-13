<?php

namespace Models;
  
class MenuRole extends BasedModel
{ 
    protected $table = 'menu_role';
    
    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
