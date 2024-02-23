<?php

namespace app\core\form ;

use app\core\Model;

class Field {  

    public Model $model ;  
    public string $type ; 
    public string $attribute ; 
    const TEXT_FIELD = "text" ; 
    const EMAIL_FIELD = "email" ; 
    public function __construct($model , $attribute) 
    {

        $this->model = $model;
        $this->type= Field::TEXT_FIELD; 
        $this->attribute = $attribute;
    } 

    public function __toString()
    {
        return sprintf('<div> 
        <label >%s</label>
          <input type="%s" name="%s" value="%s">
          %s
         </div>' , $this->attribute ,$this->type , $this->attribute , $this->model->{$this->attribute} ,
         $this->model->hasError($this->attribute) ? '<p>'.$this->model->getError($this->attribute).'</p>':''
        ); 
    } 

    public function emailField(){ 
        $this->type = Field::EMAIL_FIELD;
        return $this;
    }
}
