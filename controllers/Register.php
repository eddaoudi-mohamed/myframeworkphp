<?php
namespace app\controllers ;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModule;

class Register extends Controller {  
    /**
     * Class constructor.
     */ 
    public RegisterModule $registerModel ; 
    public function __construct()
    {
      $this->registerModel = new RegisterModule() ; 
      
    }
    public  function index(){  
      Controller::setLayout("authLayout");
      return  $this->renderView('register' , ['model'=>$this->registerModel]);
    } 
    public  function register(Request $request){ 
       $body =  $request->getBody() ; 

       $this->registerModel->loadData($body) ;
       
      if($this->registerModel->validation()){ 
        echo  "success"  ; 
        return true ; 
      }
      Controller::setLayout("authLayout");
      return  $this->renderView('register' , ['model'=>$this->registerModel]);
    }
}
 