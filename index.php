<?php

session_start();


    $sessionActiva=isset($_SESSION['usuario'])?true:false;


    if(!$sessionActiva){
      header('Location:login.php');
    
    }
        header('Location:sistema.php');
    

    

















?>