<?php


    $archivo = isset($_SERVER['argv'][0])?$_SERVER['argv'][0]:"";
    $controlador= isset($_SERVER['argv'][1])?$_SERVER['argv'][1]:"";

    if($archivo == "comandos.php"|| $archivo== "./comandos.php" || $archivo== ".\comandos.php"){

        print_r(" \n \n Se esta ejecutando correctamente \n \n");



        $arrayComando['pruebaGenerica']="controladorGenerico";

        if(isset($arrayComando[$controlador])){

            require_once("Comandos/controladores/".$arrayComando[$controlador].".php");
            $objComando= new $arrayComando[$controlador]();
            $objComando->procesar();
            $objComando->resultados();


        }else{
            print_r(" \n \n Error en el comando \n \n");

        }

       


    }else{

        print_r(" \n \n No se esta ejecutando correctamente \n \n");


    }





?>