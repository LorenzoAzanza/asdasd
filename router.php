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
        }elseif($formulario=="clientes"){
        
                include("Vistas/clientes.php");
        }elseif($formulario=="ingresar_clientes"){
        
                include("Vistas/ingresar_clientes.php");
        }elseif($formulario=="borrar_clientes"){
        
                include("Vistas/borrar_clientes.php");
        }elseif($formulario=="editar_clientes"){
        
                include("Vistas/editar_clientes.php");
        }elseif($formulario=="mi_panel"){
        
                include("Vistas/mi_panel.php");
        }elseif($formulario==""){

                include("Vistas/principal.php");
                 
        }elseif($formulario=="reservas"){

                include("Vistas/reservas.php");
                 
        }elseif($formulario=="usuarios"){

                include("Vistas/usuarios.php");
                 
        }


        else{ 
            
            echo("<h1>ERROR 404</h1>");

        }







?>