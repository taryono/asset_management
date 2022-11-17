<?php

namespace Models;
 
class Staff extends BasedModel
{ 
    protected $appends = ['name'];
    public function structure(){
        return $this->belongsTo(Structure::class);
    }
    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} - {$this->last_name}";
    }
}
