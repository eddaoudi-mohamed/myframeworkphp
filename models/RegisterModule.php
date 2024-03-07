<?php

namespace app\models ;

use app\core\DBModel;

class RegisterModule extends DBModel { 


    const STATUS_INACTIVE = 0 ; 
    const STATUS_ACTIVE = 1 ; 
    const STATUS_DELETED = 2; 
    public string $name = ""; 
    public string $email  = "";  
    public  $status = self::STATUS_INACTIVE  ; 

    public function __construct()
    {

    }   


     public function  primarykey(): string
     {
        return 'id' ; 
     }

    public function tableName()
    {
        return "Persons" ; 
    }

    public  function register(){
        // if you want to change some feild you can change in here 
        $this->save();
     }
    public function  attributes():array
    {
        return [ 
                "name"  ,
                "email" , 
                "status"
        ] ; 
    }

    public function rules(): array
    {
        return [
            "name"=>[self::REQUIRED] , 
            "email"=>[self::REQUIRED , self::EMAIL , [self::UNIQUE , 'table'=>$this->tableName() ]] , 
        ] ;
    } 
     
    
}



?>