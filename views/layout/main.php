


<h1>Header</h1> 

<?php 
    use app\core\Application  ; 
    $sessionInfoSuccess = Application::$app->session->getFlash('success') ; 
    if ($sessionInfoSuccess){ 
        echo $sessionInfoSuccess;
    }

?>
{{content}} 
<h1>Footer </h1>

