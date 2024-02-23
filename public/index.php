<?php

use app\core\Application;
use app\controllers\Login;
use app\controllers\Register;
use app\controllers\SiteController;


require_once __DIR__ .'/../vendor/autoload.php' ;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load(); 

$config = [ 
    'db'=>[ 
        'dsn'=> $_ENV['DB_DSN'] , 
        'user'=> $_ENV['DB_USER'] ,
        'password'=> $_ENV['DB_PASSWORD'] 
    ]
] ; 
echo $_ENV['DB_DSN'] ; 
$app = new Application(dirname(__DIR__) , $config) ; 
$app->router->get('/' , [SiteController::class , "index"]) ; 

$app->router->get('/contact' , function(){ 
    return "welcom to contact page " ; 
}) ; 

$app->router->get('/login' , [Login::class , 'index']) ; 
$app->router->post('/login' , [Login::class , 'login']) ;


$app->router->get('/register' , [Register::class , 'index']) ; 
$app->router->post('/register' , [Register::class , 'register']) ; 

$app->router->post('/submit' , [SiteController::class , "handleSubmitForm"]) ; 
$app->run() ; 
 

