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


   public function applyMigrations(){ 

    $this->createMigrationTable();
    $appliedMaigration =  $this->getAppliedMigrations(); 


    $files = scandir(Application::$ROOT_DIR."/migrations") ;  
    $newMigrations  = [] ; 
    $toApplyMaigration = array_diff($files ,$appliedMaigration) ; 
    foreach($toApplyMaigration as $migration){ 
        if($migration == "." || $migration == ".."){ 
            continue ; 
        } 

        require_once Application::$ROOT_DIR."/migrations/$migration"; 
        $className = pathinfo($migration, PATHINFO_FILENAME)  ; 

        $instance = new $className();  
        $this->log("applying migration $migration");

        $instance->up() ; 


        $this->log(" applied migration .$migration");

        $newMigrations[] = $migration ;
    } 

     if(!empty($newMigrations)){ 
        $this->saveMigrations($newMigrations);
     }else{ 
        $this->log("All migration are applied ");
     }


   }

   public function saveMigrations(array $migrations){ 
    
     $str = implode(","  , array_map(fn($m)=>"('$m')" , $migrations)) ;  

    $statement =   $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
    $statement->execute(); 


   } 



   public function createMigrationTable(){ 
    $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(200) , 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
   } 


   public function getAppliedMigrations(){ 
    $statement = $this->pdo->prepare("SELECT migration FROM migrations"); 
    $statement->execute() ; 
    return $statement->fetchAll(\PDO::FETCH_COLUMN) ; 
   } 

   public  function log($message){ 
     echo "[".date("Y-m-d H:i:s")."] - ".$message.PHP_EOL; 
   }
}
