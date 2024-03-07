<?php 

namespace app\core ;


abstract class DBModel extends Model { 
   abstract public function tableName() ; 
   abstract public function  attributes():array ; 
   abstract public function  primarykey():string ; 

    public function save() { 
      $tableName = $this->tableName(); 
      $attributes = $this->attributes();
      $atterbiteInsert = implode("," , $attributes) ;  
      $params  = implode("," , array_map(fn($attri)=> ":$attri" ,$attributes)) ; 
      // $params  = implode("," , $declareParams);
      $statement = $this->prepare("INSERT INTO $tableName ($atterbiteInsert) VALUES ($params) "); 
      foreach($attributes as $attr){  
        $statement->bindValue(":$attr", $this->{$attr}) ; 
      }

      $statement->execute() ; 
      return true ; 
    } 


    public   function findOne(array $where){ //
      $tableName = $this->tableName(); 
      $attributes = array_keys($where) ;
      $params = implode( " AND " ,  array_map(fn($attr)=>"$attr = :$attr"  , $attributes)) ; 

      $SQL =  "SELECT * FROM $tableName WHERE $params"  ; 
      $statement =    $this->prepare($SQL); 

      foreach($where  as $key => $value){ 
        $statement->bindValue(":$key" , $value) ; 
      }

      $statement->execute() ; 

      return $statement->fetchObject(static::class) ; 


    }



    public function prepare($sql){ 
      return Application::$app->db->pdo->prepare($sql); 
    }
}
