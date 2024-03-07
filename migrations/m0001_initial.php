<?php

use app\core\Application;

class m0001_initial { 
    public function up()
    {
       $db = Application::$app->db ; 

       $SQL = "CREATE TABLE Persons (
        id int AUTO_INCREMENT PRIMARY KEY,
        email varchar(255),
        name  varchar(255),
        status varchar(255),
        City varchar(255)
      );" ; 

      $db->pdo->exec($SQL) ; 
    }

    public function down()
    {
       $db = Application::$app->db ; 
       $SQL = "DROP TABLE Persons;" ; 

       $db->pdo->exec($SQL) ;  
        

    }
}


?>