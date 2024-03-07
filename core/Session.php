<?php 

namespace app\core ; 

class Session { 
    /**
     * Class constructor.
     */


     protected  const  FLASH_KEY = "flash_messages" ; 
    public function __construct()
    {
        session_start() ; 
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? []; 
        foreach($flashMessages as $key => &$flashMess){ 
            // mark to be removed 
            $flashMess['remove'] = true ; 
        } 
      $_SESSION[self::FLASH_KEY] = $flashMessages ; 
    }

   public function setFlash($key  , $message)
   { 

    $_SESSION[self::FLASH_KEY][$key] = [ "value" => $message , "remove"=> false]; 


   }

   public  function getFlash($key){ 

        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false; 

   }

   /**
    * Class destructor.
    */
   public function __destruct()
   {
        // iterate over marked to be removed 

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? []; 
        foreach($flashMessages as $key => &$flashMess){ 
            if($flashMess['remove']){ 
                unset($flashMessages[$key]) ; 
            }
        } 
        $_SESSION[self::FLASH_KEY] = $flashMessages ; 
   }


}
