<?php 

namespace app\controllers ;

use app\core\Controller;
use app\core\Request;

/**
 * Class SiteContoller
 * 
 * @package app\controllers
*/

class SiteController extends Controller {  

    public  function index(){  
        
        // return Application::$app->router->renderView('home' , ['name'=>"mohmaed eddaoudi"])  ; 
        // return SiteController::renderView('home' , ['name'=>'mohamed Eddaoudi']);
        return  $this->renderView('home', ['name'=>'mohamed Eddaoudi']);

    }

    public  function handleSubmitForm(Request $request){  


        $body  = $request->getBody();  

        echo "<pre>";
          var_dump($body) ; 
        echo "</pre>" ;

        return "handler submit form in home page " ; 
    }

}
