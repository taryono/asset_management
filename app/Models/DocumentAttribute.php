<?php

namespace Models;
 
use Illuminate\Support\Facades\Validator; 
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentAttribute extends BasedModel {
    use SoftDeletes; 
    
    protected $guarded = ['id'];
    protected $dates = ['deleted_at']; 
    
    public static $rules = array();

    public function validate($data)
    {
        $v = Validator::make($data, DocumentAttribute::$rules);
        return $v;
    }

    public function document() {
        return $this->belongsTo(Document::class);
    }

    public function parent() {
        return $this->belongsTo(DocumentAttribute::class, 'parent_id', 'id');
    } 
 
}
