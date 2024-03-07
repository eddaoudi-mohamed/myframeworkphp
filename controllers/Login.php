<?php
namespace app\controllers ;

use app\core\Request;
use app\core\Controller;
use app\core\Response;
use app\models\LoginModel;

class Login extends Controller { 

    /**
     * Class constructor.
     */
    public $model  ; 
    public function __construct()
    {
            $this->model = new LoginModel();
    }
    public  function index(){ 
        Controller::setLayout("authLayout");
        return  $this->renderView('login' ,['model'=>$this->model]);

    } 

    public  function login(Request $request , Response $response){ 
        $body  = $request->getBody() ;   
        $this->model->loadData($body) ; 

        if($this->model->validation($body) && $this->model->login()){ 
            $response->redirect('/') ; 
            exit ;   
        }
        Controller::setLayout("authLayout");
        return  $this->renderView('login' ,['model'=>$this->model]);
        
    }
}
