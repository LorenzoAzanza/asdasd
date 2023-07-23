<?php

        $formulario = isset($_GET['r'])?$_GET['r']:"";


        if($formulario=="formulario"){
           
            include("Vistas/formulario.php");

        }elseif($formulario=="vehiculos"){

                include("Vistas/vehiculos.php");

        }elseif($formulario=="ingresar_vehiculos"){
                include("Vistas/ingresar_vehiculos.php");

        }

        elseif($formulario=="borrar_vehiculos"){
                include("Vistas/borrar_vehiculos.php");


        } elseif($formulario=="editar_vehiculos"){
        
                include("Vistas/editar_vehiculos.php");
        }elseif($formulario=="vehiculos_venta"){
        
                include("Vistas/vehiculos_venta.php");
        }elseif($formulario=="usuarios"){
        
                include("Vistas/usuarios.php");
        }elseif($formulario=="ingresar_usuarios"){
        
                include("Vistas/ingresar_usuarios.php");
        }elseif($formulario=="borrar_usuarios"){
        
                include("Vistas/borrar_usuarios.php");
        }elseif($formulario=="editar_usuarios"){
        
                include("Vistas/editar_usuarios.php");
        }elseif($formulario=="mi_panel"){
        
                include("Vistas/mi_panel.php");
        }


        else{ 
            
            echo("<h1>ERROR 404</h1>");

        }







?>