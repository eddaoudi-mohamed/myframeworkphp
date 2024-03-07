<?php
namespace app\controllers ;

use app\core\Request;
use app\core\Response;
use app\core\Controller;
use app\core\Application;
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
    public  function register(Request $request ,   Response $response ){ 
       $body =  $request->getBody() ; 

       $this->registerModel->loadData($body) ;
       
      if($this->registerModel->validation() && $this->registerModel->register()){ 
        Application::$app->session->setFlash('success' , "Thanks for register") ; 
        Application::$app->response->redirect('/') ; 
        exit ; 
      }
      Controller::setLayout("authLayout");
      return  $this->renderView('register' , ['model'=>$this->registerModel]);
    }
}
 