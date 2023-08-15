<?php

        $formulario = isset($_GET['r'])?$_GET['r']:"";


        if($formulario=="formulario"){
           
            include("sendemail/formulario.php");

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
        }elseif($formulario=="perfil"){
        
                include("Vistas/perfil.php");
        }elseif($formulario==""){

                include("Vistas/principal.php");
                 
        }elseif($formulario=="reservas"){

                include("Vistas/reservas.php");
                 
        }elseif($formulario=="tipo_usuario"){

                include("Vistas/tipo_usuario.php");
                 
        }elseif($formulario=="editar_tipoUsuario"){

                include("Vistas/editar_tipoUsuario.php");
                 
        }elseif($formulario=="editar_reserva"){

                include("Vistas/editar_reservas.php");
                 
        }elseif($formulario=="borrar_reserva"){

                include("Vistas/borrar_reservas.php");
                 
        }elseif($formulario=="ingresar_reservas"){

                include("Vistas/ingresar_reservas.php");
                 
        }elseif($formulario=="perfil_usuarios"){

                include("Vistas/perfil_usuarios.php");
                 
        }elseif($formulario=="reservar"){

                include("Vistas/reservar.php");
                 
        }elseif($formulario=="enviar"){

                include("sendemail/enviar.php");
                 
        }

        else{ 
            
            echo("<h1>ERROR 404</h1>");

        }







?>