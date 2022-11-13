<?php

namespace Models;

use App\Models\User;

class Page extends BasedModel
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function children(){
        return $this->hasMany(Page::class, 'parent_id','id')->where('parent_id', $this->id)->orderBy('sequence', 'asc');
    } 

    public function parent(){
        return $this->belongsTo(Page::class, 'parent_id','id');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }
}
