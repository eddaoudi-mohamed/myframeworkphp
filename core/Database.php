<?php 

namespace app\core ; 

class Database { 


    public \PDO $pdo ; 


    /**
     * Class constructor.
     */

    public function __construct(array $config)
    { 

        // $dsn = $config['dsn'] ?? ''   ; 
        // $user = $config['user'] ?? ''   ; 
        // $password = $config['password'] ?? ''   ; 

        
        
        // try {
        //     $this->pdo = new \PDO($dsn , $user , $password) ; 
    
        //     $this->pdo->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION); 

        // } catch (\PDOException $e) {
        //     // attempt to retry the connection after some timeout for example 

        //     echo "Connection failed: " . $e->getMessage();

        // }


        $dsn = "mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=test";
        $username = "root";
        $password = "mauFJcuf5dhRMQrjj";

        try {
            $pdo = new \PDO($dsn, $username, $password);
            // Set PDO attributes if needed
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // Perform database operations
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
            }
    
}
