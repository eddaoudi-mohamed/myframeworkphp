<?php


namespace app\models ; 
// use app\core\DBModel;
use app\core\Model;

class LoginModel extends Model { 
    
    const STATUS_INACTIVE = 0 ; 
    const STATUS_ACTIVE = 1 ; 
    const STATUS_DELETED = 2; 
    public string $name = ""; 
    public string $email  = "";  
    public  $status = self::STATUS_INACTIVE  ; 

    // public function __construct()
    // {

    // }  


    // public function tableName()
    // {
    //     return "Persons" ; 
    // }


    // public function  attributes():array
    // {
    //     return [ 
    //             "name"  ,
    //             "email" , 
    //     ] ; 
    // } 
    public function login(){ 
        $objPersonne = new RegisterModule();  
        $personne = $objPersonne->findOne(['email'=>$this->email]) ; 

        if(!$personne){ 
            $this->addError('email' ,self::NOTEXISTE);
            return  false ; 
        }
    }


    public function rules(): array
    {
        return [
            "name"=>[self::REQUIRED] , 
            "email"=>[self::REQUIRED , self::EMAIL ] , 
        ] ;
    } 
     

}
