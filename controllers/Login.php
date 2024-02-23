<?php
namespace app\controllers ;

use app\core\Controller;
use app\core\Request;

class Login extends Controller { 
    public  function index(){ 
        Controller::setLayout("authLayout");
        return  $this->renderView('login');

    } 

    public  function login(Request $request){ 
        $body  = $request->getBody() ; 
        echo "<pre>"; 
        print_r($body) ; 
        echo "</pre>" ; 
    }
}
