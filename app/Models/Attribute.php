<?php

namespace Models;
 
class Attribute extends BasedModel
{
    public function controller() {
        return $this->belongsTo(Controller::class);
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }
}
