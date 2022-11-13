<?php

namespace Models; 

class Position extends BasedModel
{
    public function people()
    {
        return $this->belongsToMany(People::class);
    }
}
