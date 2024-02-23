<?php

namespace app\models ;

use app\core\Model;

class RegisterModule extends Model { 




    public function __construct()
    {

    }  
    public string $name = ""; 
    public string $email  = "";  



    public function rules(): array
    {
        return [
            "name"=>[self::REQUIRED] , 
            "email"=>[self::REQUIRED , self::EMAIL] , 
        ] ;
    }

}



?>