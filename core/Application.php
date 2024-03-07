<?php
namespace app\core ; 
/**
 * class Application
 * @package app\core
*/

class Application {  

    public static $ROOT_DIR ; 
    public Router $router ; 
    public Request $request ; 
    public Response $response ;  
    public static Application  $app ; 
    public Controller $controller ; 
    public Database $db ; 
    public Session $session;  

    public function __construct($rootPath , array $config)
    {
        $this->session = new Session();
        self::$ROOT_DIR = $rootPath ;  
        self::$app = $this;
        $this->response = new Response() ;
        $this->request = new Request() ; 
        $this->router = new Router($this->request , $this->response); 
        $this->controller = new Controller(); 
        $this->db = new Database($config['db']);

    } 
    public function run(){ 
        // todo  
       echo $this->router->resolve();
    }
}

