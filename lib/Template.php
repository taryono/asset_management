<?php

namespace Lib;

use Form;

class Template
{ 
    protected $name;
    protected $value = null;
    protected $attributtes = [];
    protected $classes = "form-control";
    protected $required = "required";
    protected $disabled = "disabled";
    protected $data = null;
    protected $type = 'text';

    public function __construct($name,$attributtes = [], $value = null)
    { 
        $this->name = $name;
        $this->attributtes = $attributtes;
        $this->value = $value;
    }

    public function setParams($params)
    {   $this->name = data_get($params,0, null);
        
        if($this->type == "select"){
            $this->value = data_get($params,2, null);
            $this->data = data_get($params,1, []);
            $this->attributtes = data_get($params,3, []);
        }else{
            $this->value = data_get($params,1, null);
            $this->attributtes = data_get($params,2, []);
        } 
    }

    public function setAttributes($attributtes)
    {   
        if(!array_key_exists("class", $attributtes)){
            $attributtes['class'] = "form-control";
        }
        $this->attributtes = $attributtes;
        return $this;
    }

    public function disabled()
    {    
        $attributtes['disabled'] = "disabled";
        $this->attributtes = $attributtes;
        return $this;
    }

    public function required()
    {   
        $attributtes['required'] = "required";
        $this->attributtes = $attributtes;
        return $this;
    }

    public function getAttributes()
    {
        return $this->attributtes;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function templates()
    {   $types = [];
        try { 
            $data = !is_null($this->getData())?$this->getData():[];
           
             $types =  [
                 'number' => Form::number($this->getName(), $this->value, $this->getAttributes()),
                 'date' => Form::date($this->getName(), $this->value, $this->getAttributes()),
                 'text' => Form::text($this->getName(), $this->value, $this->getAttributes()),
                 'select' => Form::select($this->getName(), $data, $this->value, $this->getAttributes()),
                 'color' => Form::color($this->getName(), $this->value, $this->getAttributes()),
                 'radio' => Form::radio($this->getName(), $this->value, $this->getAttributes()),
                 'checkbox' => Form::checkbox($this->getName(), $this->value, $this->getAttributes()),
                 'textarea' => Form::textarea($this->getName(), $this->value, $this->getAttributes()),
            ]; 
        } catch (\Throwable $th) {
            dump($th->getTraceAsString());
        }
        return $types;
    }

    public function formGroup($type = "text", $values = [], $label = false)
    {   
        $label = "";
        if(array_key_exists("label", $this->getAttributes())){
            $label = $this->getAttributes()['label'];
        }else if(array_key_exists("placeholder", $this->getAttributes())){
            $label = $this->getAttributes()['placeholder'];
        }else{

        } 
        
        $template = '<div class="col-lg-12">';
        $template .=     '<div class="form-group">'; 
        if($label){
            $template .= '<label for="'.$this->name.'">'.$label.'</label>';
        }
        if($values){
            $template .= '<br>';
            foreach($values as $key => $v){
                $this->value = $key ;
                $template .= $this->$type(). $v. "&nbsp;";
            }
        }else{
            $template .= $this->$type();
        }
        

        $template .=    '</div>';
        $template .= '</div>';
        
        return $template;
    }

    public function number()
    { 
        return $this->templates()['number'];
    }

    public function tanggal()
    { 
        return $this->templates()['date'];
    }

    public function text()
    {    
        return $this->templates()['text'];
    }

    public function select()
    {    
        return array_key_exists('select', $this->templates())? $this->templates()['select']:"";
    }

    public function colour()
    {    
        return $this->templates()['color'];
    }

    public function radio()
    { 
        return $this->templates()['radio'];
    }

    public function checkbox()
    { 
        return $this->templates()['checkbox'];
    }

    public function textarea()
    {    
        return $this->templates()['textarea'];
    }
}
