<?php 

namespace app\core ; 
/**
 * class Router
 * @package app\core
*/

class Router {  
    protected array $routes = [] ;   
    
    public Request $request ; 
    public  Response $response; 

    /**
     * Router constructer 
     * @param \app\core\Request 
     * @param \app\core\Response 
    */
    public function __construct(Request $request ,Response $response)
    { 
      $this->request = $request;
      $this->response = $response; 
    } 

    /**
     * @param string $path  , callback :  $callback  , $view  
    */


    public function get($path  , $callback){ 
        $this->routes['get'][$path] = $callback;
    } 

    public function post($path  , $callback){ 
      $this->routes['post'][$path] = $callback;
    } 

    /**
     *@return  the current path and method 
     * 
    */


    public function resolve() { 
       $path =  $this->request->getPath(); 
       $method = $this->request->getMethod();  
       $callback =   $this->routes[$method][$path] ?? false; 
       if ($callback == false){  
        //  Application::$app->response->setStatusCode(404) ;  
        $this->response->setStatusCode(404);
         return  $this->renderContent("not found " );   
         exit ; 
       }

       if(is_string($callback)){ 
        return $this->renderView($callback);
       }

       if (is_array($callback)){ 
        $callback[0] = new $callback[0] ; 
       }

       return  call_user_func($callback , $this->request) ; 

        
    //    echo "<pre>" ;
    //    print_r($_SERVER) ; 
    //    echo"</pre>" ; 
    } 

    public function renderView($view , $params=[]){ 

      $layoutContent = $this->layoutContent(); 
      $ViewContent = $this->renderOnlyView($view , $params);
      return str_replace('{{content}}' , $ViewContent , $layoutContent)  ; 
    } 


    public function renderContent($Content){ 
      $layoutContent = $this->layoutContent(); 
      return str_replace('{{content}}' , $Content , $layoutContent)  ; 
    } 

    protected function layoutContent(){ 
        $layout =Controller::$layout; 
        echo "layout $layout" ; 
        ob_start() ; 
        include_once Application::$ROOT_DIR."/views/layout/$layout.php" ;  
        return  ob_get_clean() ; 
    }

    protected function renderOnlyView($view , $params){ 
      ob_start() ; 

      foreach($params as $key=>$value){ 
        $$key = $value ; 
      } ; 
      include_once Application::$ROOT_DIR."/views/$view.php";  
      return  ob_get_clean() ; 
    }
}
