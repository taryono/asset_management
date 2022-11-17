<?php

namespace Models; 

class Employee extends BasedModel
{
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
