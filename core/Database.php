<?php 

namespace app\core ; 


class Database { 


    public \PDO $pdo ; 


    /**
     * Class constructor.
     */

    public function __construct(array $config)
    { 

        $dsn = $config['dsn'] ?? ''   ; 
        $user = $config['user'] ?? ''   ; 
        $password = $config['password'] ?? ''   ; 

       
        try {
            $this->pdo = new \PDO($dsn , $user , $password) ; 
    
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);  
            echo "connection succesufuly" ; 

        } catch (\PDOException $e) {
            // attempt to retry the connection after some timeout for example 

            echo "Connection failed: " . $e->getMessage();

        }


     
            }
    
}
