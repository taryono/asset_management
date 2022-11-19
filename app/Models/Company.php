<?php

namespace Models;

class Company extends BasedModel
{ 

    public function company_type(){
        return $this->belongsTo(CompanyType::class);
    }
}
