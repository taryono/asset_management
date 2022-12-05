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

    public function __construct($name, $attributtes = [], $value = null)
    {
        $this->name = $name;
        $this->attributtes = $attributtes;
        $this->value = $value;
    }

    public function setParams($params)
    {
        $this->name = data_get($params, 0, null);

        if ($this->type == "select") {
            $this->value = data_get($params, 2, null);
            $this->data = data_get($params, 1, []);
            $this->attributtes = data_get($params, 3, []);
        } else {
            $this->value = data_get($params, 1, null);
            $this->attributtes = data_get($params, 2, []);
        }
    }

    public function setAttributes($attributtes)
    {
        if (!array_key_exists("class", $attributtes)) {
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

    public function templates($type = null)
    { 
        try {
            $data = !is_null($this->getData()) ? $this->getData() : [];
            if(!is_array($data)){
                $data = [];
            } 
 
            if($type == "select"){
                return Form::$type($this->getName(), $data, $this->value, $this->getAttributes());
            }elseif($type == "password"){
                return Form::$type($this->getName(), $this->getAttributes());
            }else{
                return Form::$type($this->getName(), $this->value, $this->getAttributes());
            }  
            
        } catch (\Exception $e) {
            dd($e->getMessage(), __METHOD__, $e->getLine());
        } 
    }

    public function formGroup($type = "text", $values = [], $label = false)
    {
        try {
            $label = "";
            if (array_key_exists("label", $this->getAttributes())) {
                $label = $this->getAttributes()['label'];
            } else if (array_key_exists("placeholder", $this->getAttributes())) {
                $label = $this->getAttributes()['placeholder'];
            } else {

            }
            if(is_array($this->name) || is_array($label)){
                dd($this->name,$label);
            }
         
            $template = '<div class="col-lg-12">';
            $template .= '<div class="form-group">';
            if ($label) {
                $template .= '<label for="' . $this->name . '">' . $label . '</label>';
            }

            if ($values) {
                $template .= '<br>';
                if(is_array($values)){ 
                    foreach ($values as $key => $v) {
                        $this->value = $key;
                        $template .= $this->templates($type) . $v . "&nbsp;";
                    }
                }
                
            } else {
                $template .= $this->templates($type);
            }

            $template .= '</div>';
            $template .= '</div>';

            return $template;
        } catch (\Exception $e) {
            dd($e->getMessage(), __METHOD__, $e->getLine());
        }
    }

    public function number()
    {
        return $this->templates('number');
    }

    public function tanggal()
    {
        return $this->templates('date');
    }

    public function text()
    {
        return $this->templates('text');
    }

    public function select()
    {
        return $this->templates('select');
    }

    public function colour()
    {
        return $this->templates('color');
    }

    public function radio()
    {
        return $this->templates('radio');
    }

    public function checkbox()
    {
        return $this->templates('checkbox');
    }

    public function textarea()
    {
        return $this->templates('textarea');
    }
}
