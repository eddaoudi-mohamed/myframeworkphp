<?php 


namespace app\core ; 

class Controller { 

   public static $layout= "main";  

   public static  function setLayout($layout) { 
    self::$layout = $layout;
   } 


  public  function renderView($view , $params= []){ 
        return Application::$app->router->renderView($view , $params) ; 
  }
}
