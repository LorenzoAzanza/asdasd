<?php


    $sessionActiva=true;


    if(!$sessionActiva){
      header('Location:login.php');
    
    }

include("Vistas/layout.php");





?>