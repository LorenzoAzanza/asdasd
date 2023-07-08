<?php

        $formulario = isset($_GET['r'])?$_GET['r']:"";


        if($formulario=="formulario"){
           
            include("Vistas/formulario.php");



        }elseif($formulario=="perfil"){

                include("Vistas/perfil.php");

        }elseif($formulario=="vehiculos"){

                include("Vistas/vehiculos.php");

        }
        else{
            
            echo("<h1>ERROR 404</h1>");

        }







?>