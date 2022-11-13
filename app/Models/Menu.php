<?php

namespace Models;

use App\Models\User;

class Menu extends BasedModel
{    
    public function role() {
        return $this->belongsToMany(Role::class);
    }

    public function user() {
        return $this->belongsToMany(User::class);
    }
    public function childrens() {
        return $this->hasMany(Menu::class,'id', 'parent_id');
    }

    public function attributes() {
        return $this->hasMany(Attribute::class);
    }

    public function getNameAttribute() {
        return $this->attributes['name'] = str_replace("-index",'',  $this->attributes['name'] );
    }

    public function parent() {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function menu_type() {
        return $this->belongsTo(MenuType::class);
    }

    public function getMutatedAttributes()
    {
        return ['parent'];
    }

     public function setParentIdAttributes($value)
    {
        $this->attributes['parent_id'] = ($value == null)?0:$value;
    }

    // public function setMutatedAttributes()
    // {
    //     return ['status','parent'];
    // }

    // public function hasAttributeSetMutator($key)
    // { 
    //     return $this->attributes[$key] =  "";
    // }

    // public function getStatusAttribute(){
    //     return $this->attributes['status'] = $this->is_active?"Aktif":"Tidak Aktif";
    // }

    public function getParentAttribute(){
        $parent = Menu::find($this->parent_id);
        return $this->attributes['parent'] = $parent;
    }
    
}
