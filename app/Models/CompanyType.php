<?php

namespace Models;

class CompanyType extends BasedModel
{ 
    public function company(){
        return $this->hasMany(Company::class);
    }
}
