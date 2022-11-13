<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

class Phone
{   
    protected  $cellphone;

    public function __construct($cellphone){
        $this->cellphone = $cellphone;
        $this->sanitize();
    }

    public  function setCellphone($cellphone){
        $this->cellphone = $cellphone; 
        return $this;
    }

    public  function getCellphone(){
        return $this->cellphone;
    }

    public  function sanitize()
    {
        $cellphone = \Models\cellphone::where('cellphone', $this->cellphone)->first();
        if($cellphone){ 
            $this->cellphone = $cellphone->cellphone;
            if(substr($this->cellphone, 0, 1) == "+"){
                $this->setCellphone($this->cellphone);
                return;
            }
            $this->setPrefix($this->cellphone); 
            return;
        } 
       
        if ($this->is_valid_format($this->cellphone)) {
            $this->setPrefix($this->cellphone); 
            return;
        } 

        $phone = trim(str_replace(" ","",$this->cellphone));

        if(empty($phone)){
            $this->setCellphone("6287883732016");
            return;
        }

        if($phone <= 0){
            if($phone == '0'){
                $this->setCellphone("6287883732016");
                return;
            }
            if (strpos($phone, "'")) {
                $this->setCellphone("6287883732016");
                return;
            }
        }

        /**
         * If indicate only one cellphone number
         */ 
        if (strpos($phone, ",")) {

            $numbers = explode(',', $phone); 
            /**
             * cellphone: 081319170008, 081319170009
             */ 
          
            $lengths = array_map('strlen', $numbers);

            if(max($lengths) >  8){
                foreach($numbers  as $number){
                    if($this->is_valid_format($number)){
                        $this->setPrefix($number); 
                        return; 
                    }
                } 
            } 
            if(!$this->is_valid_format($phone)){ 
                $phone = str_replace(",","",$phone);
            }
            
            if(!$this->is_valid_format($phone)){
                $this->setCellphone("087883732016");
                return;
            }
        }
        
        if (strpos($phone, "-")) {

            $numbers = explode('-', $phone);

            /**
             * cellphone: 0813 - 1917 - 0008
             */
          
            $lengths = array_map('strlen', $numbers);

            if(max($lengths) > 8){
                foreach($numbers  as $number){
                    if($this->is_valid_format($number)){
                        $this->setPrefix($number); 
                        return; 
                    }
                } 
            } 
            
            if(!$this->is_valid_format($phone)){
                $phone = str_replace("-","",$phone);
            }
            
            if(!$this->is_valid_format($phone)){
                $this->setCellphone("087883732016");
                return;
            }
            
        }

        if (strpos($phone, "/")) {
            $numbers = explode('/', $phone);
            $lengths = array_map('strlen', $numbers);
            if(max($lengths) > 8){
                foreach($numbers  as $number){
                    if($this->is_valid_format($number)){
                        $this->setPrefix($number); 
                        return; 
                    }
                } 
            }
            
            if(!$this->is_valid_format($phone)){
                $phone = str_replace("/","",$phone);
            }

            if(!$this->is_valid_format($phone)){
                $this->setCellphone("087883732016");
                return;
            }
        } 
        
        $phone = $this->getNumeric($phone);   
        if(!$this->is_valid_format($phone)){
            $this->setPrefix($phone);            
        }
         
        if($this->is_valid_format($phone)){ 
            $this->setPrefix($phone); 
            return; 
        } 
        $this->setPrefix($phone); 
        return $this;
    }

    public  function is_valid_format($phone)
    { 
        /*
         * 
          telkomsel.regex = ^(\\+62|\\+0|0|62)8(1[123]|52|53|21|22|23)[0-9]{5,9}$
          simpati.regex = ^(\\+62|\\+0|0|62)8(1[123]|2[12])[0-9]{5,9}$
          as.regex = ^(\\+62|\\+0|0|62)8(52|53|23)[0-9]{5,9}$
          indosat.regex= ^(\\+62815|0815|62815|\\+0815|\\+62816|0816|62816|\\+0816|\\+62858|0858|62858|\\+0814|\\+62814|0814|62814|\\+0814)[0-9]{5,9}$
          im3.regex = ^(\\+62855|0855|62855|\\+0855|\\+62856|0856|62856|\\+0856|\\+62857|0857|62857|\\+0857)[0-9]{5,9}$
          xl.regex = ^(\\+62817|0817|62817|\\+0817|\\+62818|0818|62818|\\+0818|\\+62819|0819|62819|\\+0819|\\+62859|0859|62859|\\+0859|\\+0878|\\+62878|0878|62878|\\+0877|\\+62877|0877|62877)[0-9]{5,9}$
          smart.regex = ^(\\+62|\\+0|0|62)8(81|87)[0-9]{5,9}$
          fren.regex = ^(\\+62|\\+0|0|62)8(88|89)[0-9]{5,9}$
          tri.regex = ^(\\+62|\\+0|0|62)8(98|99)[0-9]{5,9}$
          BYRU.regex = ^(\\+62|\\+0|0|62)8(68)[0-9]{5,9}$

         */
        
        if (preg_match("/^(\\+62|\\+0|0|62)8(1[123]|52|53|21|22|23)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62|\\+0|0|62)8(1[123]|2[12])[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62|\\+0|0|62)8(52|53|23)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62815|0815|62815|0897|\\+0815|\\+62816|0816|62816|\\+0816|\\+62858|0858|62858|\\+0814|\\+62814|0814|62814|\\+0814)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62855|0855|62855|\\+0855|\\+62856|0856|62856|\\+0856|\\+62857|0857|62857|\\+0857)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62817|0817|62817|\\+0817|\\+62818|0818|62818|\\+0818|\\+62819|0819|62819|\\+0819|\\+62859|0859|62859|\\+0859|\\+0878|\\+62878|0878|62878|\\+0877|\\+62877|0877|62877)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62|\\+0|0|62)8(81|87)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62|\\+0|0|62)8(88|89)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62|\\+0|0|62)8(95|96|98|99)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62|\\+0|0|62)8(68)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62|\\+0|0|62)8(51|81|82)[0-9]{5,9}$/", $phone)) {
            return true;
        } else if (preg_match("/^(\\+62|\\+0|0|62)8(38)[0-9]{5,9}$/", $phone)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @params $string : nisn or other
     *  
     */
    public  function getNumeric($phone){
        $phone = str_replace(" ", "", $phone);
        preg_match_all('!\d+!', $phone, $matches);   
        return join("",$matches[0]);
    }

    public  function str_replace_first($from, $to, $content)
    {   $from = '/' . preg_quote($from, '/') . '/';
        return preg_replace($from, $to, $content, 1);
    }

    public  function setPrefix($phone){
        /** this function just for local cellphone number support */
        if (substr($phone, 0, 2) == "00") {
            $phone = str_replace("00", "", $phone);
        }

        $phone = $this->str_replace_first("+", "", $phone); 
        if(substr($phone, 0, 1) == "8"){
            $phone = "62" . $phone;
        }
         
        if(substr($phone, 0, 1) == "0"){
            $phone = $this->str_replace_first("0", "62", $phone); 
        }
          
        $this->setCellphone($phone);
        return $this;
    } 
}
