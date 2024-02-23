<?php

namespace app\core ; 


abstract class Model { 
    public const REQUIRED = "required" ; 
    public const EMAIL = "EMAIL"; 
    public array $errors; 
    public function loadData($data){ 
        foreach($data as $key => $value){ 
            if(property_exists($this , $key)){ 
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules():array ; 

    public function validation(){ 
        foreach ($this->rules() as $attribute  => $rules) {
            $value =  $this->{$attribute};
            foreach ($rules as $rule) {
                if($rule === self::REQUIRED && !$value){ 
                    $this->addError($attribute , self::REQUIRED);
                }
                if($rule === self::EMAIL && !filter_var($value , FILTER_VALIDATE_EMAIL)){ 
                    $this->addError($attribute , self::EMAIL);
                }
            }
        } 

        return empty($this->errors) ; 

    }

    protected function addError($attribute , $rule){  
        $errorMessage  =  $this->errorMessage()[$rule] ?? '';
        $this->errors[$attribute][] = $errorMessage ; 
    }


    protected  function errorMessage(){ 
        return [ 
            self::REQUIRED => "this field is required " , 
            self::EMAIL => "this field must be email " ,  
        ] ; 
    } 

    public function getAttribute($attribute){ 
        if(property_exists($this , $attribute)){ 
            return $this->{$attribute};
        }
    }

    public function hasError($attribute){ 
        if(property_exists($this , $attribute)){ 
            return $this->errors[$attribute] ?? false;
        }
    }

    public function getError($attribute){ 
        if(property_exists($this , $attribute)){ 
            return $this->errors[$attribute][0];
        }
    }



}

?>