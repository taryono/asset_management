<?php

namespace Models;

use App\Models\User;

class MenuUser extends BasedModel
{ 
    protected $table = 'menu_user';
    
    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
