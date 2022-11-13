<?php

namespace Models;
 
class MenuType extends BasedModel
{  
    public function menu() {
        return $this->hasMany(Menu::class);
    }
}
