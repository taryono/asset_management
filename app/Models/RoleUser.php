<?php

namespace Models;

use App\Models\User; 
class RoleUser extends BasedModel
{ 
    public $table = 'role_user';
    
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
