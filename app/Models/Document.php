<?php

namespace Models;
 
use Illuminate\Support\Facades\Validator;  

class Document extends BasedModel { 
    
    protected $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public static $rules = array();

    public function validate($data)
    {
        $v = Validator::make($data, Document::$rules);
        return $v;
    }

    public function document_attribute() {
        return $this->hasMany(DocumentAttribute::class);
    }

    public function getCss() {
        return $this->document_attribute->where('code', 'css')->first();
    }

    public function getHeader() {
        return $this->document_attribute->where('code', 'header')->first();
    }

    public function getFooter() {
        return $this->document_attribute->where('code', 'footer')->first();
    } 
 
}
