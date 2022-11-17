<?php

namespace Models; 

class Position extends BasedModel
{
    public function employee()
    {
        return $this->belongsToMany(Employee::class);
    }
}
